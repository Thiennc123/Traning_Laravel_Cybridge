<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Gate;
use RealRashid\SweetAlert\Facades\Alert;
use App\Exports\UsersExport;
use Excel;



class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        if (Gate::allows('show_listUser')) {
            $user = User::orderBy('id', 'desc')->paginate(10);

            return view('userViews.listUser', ['listUsers' => $user]);
        } else {
            Alert::warning('Warning Title', 'Ban khong co quyen truy cap vao day');


            return view('dashboard');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {


        if (Gate::allows('add_User')) {
            $role = Role::all();
            return view('userViews.addUser', ['listRoles' => $role]);
        } else {
            Alert::warning('Warning Title', 'Ban khong co quyen truy cap vao day');


            return redirect()->back();
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = new User;

        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();
        $user->roles()->attach($request->role_id);

        return redirect()->route('users.index');
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {



        if (Gate::allows('add_User')) {
            $role = Role::all();
            $user = User::find($id);
            $roleUser = $user->roles;
            return view('userViews.editUser', ['roleUsers' => $roleUser, 'user' => $user, 'listRoles' => $role]);
        } else {
            Alert::warning('Warning Title', 'Ban khong co quyen truy cap vao day');


            return redirect()->back();
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        User::find($id)->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $user = User::find($id);
        $user->roles()->sync($request->role_id);

        return redirect()->route('users.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {


        if (Gate::allows('add_User')) {
            User::find($id)->delete();
            return redirect()->route('users.index');
        } else {
            Alert::warning('Warning Title', 'Ban khong co quyen truy cap vao day');


            return redirect()->back();
        }
    }


    public function exportFile()
    {
        return Excel::download(new UsersExport, 'userlist.csv');
    }
}
