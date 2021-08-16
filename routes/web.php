<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\EventController;
use App\Http\Controllers\GuestController;
use App\Http\Controllers\Admin\AuthController;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__ . '/auth.php';


Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

    return redirect('/dashboard');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();

    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

Route::get('/profile', function () {
    // Only verified users may access this route...
})->middleware('verified');


//user controller




Route::resource('events', App\Http\Controllers\EventController::class)->middleware('auth');
//Route::resource('events', EventController::class)->middleware('auth');

Route::get('showImportEvent', [EventController::class, 'showimportEvent'])->middleware('auth')->name('events.showFormImport');



Route::resource('guests', GuestController::class)->middleware('auth');
Route::get('detailUser', [UserController::class, 'show'])->middleware('auth')->name('users.details');
Route::post('confirmEvent', [EventController::class, 'showConfirmtEvent'])->name('events.confirmEvent');
Route::get('confirmEvent1', [EventController::class, 'showForm'])->name('events.confirmEvent1');

Route::prefix('admin')->name('admin.')->group(function () {
    Route::middleware(['guest:admin'])->group(function () {
        Route::view('/login', 'admin.login')->name('login');
        Route::post('/check', [AuthController::class, 'check'])->name('check');
    });

    Route::middleware(['auth:admin'])->group(function () {
        Route::view('/home', 'admin.home')->name('home');
        Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
        Route::resource('users', UserController::class);
        Route::resource('admins', AdminController::class);
        Route::get('getfileUser', [UserController::class, 'exportFile'])->name('users.download');
        Route::resource('events', EventController::class);
        Route::post('importEvent', [EventController::class, 'importEvent'])->name('events.ImportEvent');
        Route::get('showImportEvent', [EventController::class, 'showimportEvent'])->name('events.showFormImport');
    });
});
