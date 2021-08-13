<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use RealRashid\SweetAlert\Facades\Alert;
use App\Repositories\AdminRepositories\AdminRepositoryInterface;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public $adminRepo;

    public function __construct(AdminRepositoryInterface $adminRepo)
    {
        $this->adminRepo = $adminRepo;
    }
    public function index()
    {
        if (Gate::allows('show_listAdmin')) {

            return view('admin.adminViews.listAdmin', ['admins' => $this->adminRepo->getAll()]);
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
        if (Gate::allows('add_Admin')) {

            return view('admin.adminViews.addAdmin', ['listRoles' => $this->adminRepo->getListRole()]);
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
        $input = $request->all();

        $this->adminRepo->store($input);
        $this->adminRepo->storeAdminRole($input['role_id']);

        return redirect()->route('admin.admins.index');
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
        if (Gate::allows('edit_Admin')) {


            return view('admin.adminViews.editAdmin', ['admin' => $this->adminRepo->edit($id), 'listRoles' => $this->adminRepo->getListRole(), 'roleUsers' => $this->adminRepo->getRoleAdmin($id)]);
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
        $input = $request->all();
        $this->adminRepo->update($input, $id);
        $this->adminRepo->updateAdminRole($input['role_id'], $id);
        return redirect()->route('admin.admins.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (Gate::allows('remove_Admin')) {
            $this->adminRepo->destroy($id);
            return redirect()->route('admin.admins.index');
        } else {
            Alert::warning('Warning Title', 'Ban khong co quyen truy cap vao day');


            return redirect()->back();
        }
    }
}
