<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function check(Request $request)
    {


        $data = $request->only('email', 'password');

        if (Auth::guard('admin')->attempt($data)) {
            return redirect()->route('admin.home');
        } else {
            return redirect()->route('admin.login');
        }
    }


    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login');
    }
}
