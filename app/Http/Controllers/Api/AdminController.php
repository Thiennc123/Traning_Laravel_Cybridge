<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Models\Admin;
use Illuminate\Support\Facades\Auth;
use App\Repositories\UserRepositories\UserRepositoryInterface;

class AdminController extends Controller
{
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     * 
     */

    public $userRepo;

    public function __construct(UserRepositoryInterface $userRepo)
    {
        $this->userRepo = $userRepo;
    }
    public function index()
    {
        if (Gate::allows('show_listUser')) {
            $user = $this->userRepo->getAll();
            return response()->json([
                'user' => $user,
            ]);
        } else {
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

            return response()->json([
                'status' => true,
            ]);
        } else {
            return response()->json([
                'status' => false,
            ]);
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
        //dd($request->name);
        $input = $request->all();

        $this->userRepo->store($input);
        return response()->json([
            'status' => true,
        ]);
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
        if (Gate::allows('edit_User')) {
            return response()->json([
                'user'      => $this->userRepo->edit($id),
                'status'    => true,
            ]);

        } else {
            return response()->json([
                'status'    => false,
            ]);
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
        $input = $request->all();
        $this->userRepo->update($input, $id);
         return response()->json([
                'status'    => true,
            ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (Gate::allows('remove_User')) {
            $this->userRepo->destroy($id);
            return response()->json([
                'status'    => true,
            ]);
        } else {
            return response()->json([
                'status'    => false,
            ]);
        }
    }
}