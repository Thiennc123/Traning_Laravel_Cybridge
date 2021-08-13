<?php

namespace App\Repositories;

use Illuminate\Support\Facades\Gate;
use RealRashid\SweetAlert\Facades\Alert;


use Illuminate\Support\Facades\Hash;

use App\Repositories\RepositoryInterface;

abstract class BaseRepository implements RepositoryInterface
{
    //model muốn tương tác
    protected $model;

    //khởi tạo
    public function __construct()
    {
        $this->setModel();
    }

    //lấy model tương ứng
    abstract public function getModel();

    /**
     * Set model
     */
    public function setModel()
    {
        $this->model = app()->make(
            $this->getModel()
        );
    }

    public function getAll()
    {



        $admin = $this->model::orderBy('id', 'desc')->paginate(10);


        return $admin;
    }

    /*public function find($id)
    {
        $result = $this->model->find($id);

        return $result;
    }*/

    public function create()
    {
    }

    public function store(array $input)
    {
        //$admin = $this->model->create($input);
        //$this->model->storeAdminRole($admin->id, $input['role_id']);
        return $this->model->create($input);
    }

    public function edit($id)
    {




        $user = $this->model::find($id);
        return $user;
    }

    public function update(array $input, $id)
    {
        $this->model::find($id)->update($input);

        //$user = User::find($id);
        //$user->roles()->sync($input['role_id']);


    }


    public function destroy($id)
    {

        $this->model::find($id)->delete();
    }
}
