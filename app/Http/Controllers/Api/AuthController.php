<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::all();
        return response()->json([
            'user' => $user,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function login(Request $request)
    {

        $data = $request->only('email', 'password');

        if (Auth::guard('admin')->attempt($data)) {
            $user   = Auth::guard('admin')->user();
            
            $token  = $user->createToken($user->name);
        
            return response()->json([
                'user'      => $user,
                'token'     => $token,
                'message'   => 'dang nhap thanh cong',
                'status'    => true,

            ], 200);
        } else {
             return response()->json([
                'status'    => false,    
                'message'   => 'dang nhap khong thanh cong',
            ], 201);
        }
        // $credentials = $request->validate([
        //     'email'     => ['required', 'email'],
        //     'password'  => ['required'],
        // ]);



        // if (Auth::attempt($credentials)) {
        //     $user   = Auth()->user();
        //     $token  = $user->createToken($user->name);

        //     return response()->json([
        //         'user'      => $user,
        //         'token'     => $token,
        //         'message'   => 'dang nhap thanh cong',
        //         'status'    => true,

        //     ], 200);
        // } else {
        //     return response()->json([
        //         'status'    => false,    
        //         'message'   => 'dang nhap khong thanh cong',
        //     ], 201);
        // }
    }

    public function logout()
    {
        $accessToken    = auth()->user()->token();
        $token          = Auth::user()->tokens->find($accessToken);
        $token->revoke();
        return response(['message' => 'You have been successfully logged out.'], 200);
    }
}