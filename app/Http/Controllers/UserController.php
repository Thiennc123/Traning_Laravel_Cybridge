<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\Gate;
use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Requests\UserRequest;
use App\Exports\UsersExport;
use App\Repositories\UserRepositories\UserRepositoryInterface;
use Excel;



class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public $userRepo;

    public function __construct(UserRepositoryInterface $userRepo)
    {
        $this->userRepo = $userRepo;
    }
    public function index()
    {

        if (Gate::allows('show_listUser')) {

            return view('admin.userViews.listUser', ['users' => $this->userRepo->getAll()]);
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

            return view('admin.userViews.addUser');
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
    public function store(UserRequest $request)
    {
        $input = $request->all();

        $this->userRepo->store($input);
        return redirect()->route('admin.users.index');
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        return view('userViews.detailUser');
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

            return view('admin.userViews.editUser')->with('user', $this->userRepo->edit($id));
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
    public function update(UserRequest $request, $id)
    {


        $input = $request->all();
        $this->userRepo->update($input, $id);
        return redirect()->back();
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
            return redirect()->route('admin.users.index');
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
