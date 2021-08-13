<?php

namespace App\Repositories\AdminRepositories;

use App\Repositories\AdminRepositories\AdminRepositoryInterface;

use App\Repositories\BaseRepository;
use App\Models\Role;

class AdminRepository extends BaseRepository implements AdminRepositoryInterface
{
    //lấy model tương ứng
    public function getModel()
    {
        return \App\Models\Admin::class;
    }

    public function storeAdminRole(array $input)
    {
        $id = $this->model::latest()->first();
        $this->model->storeAdminRole($id->id, $input);
    }

    public function getListRole()
    {
        return Role::all();
    }

    public function getRoleAdmin($id)
    {
        $admin  = $this->model::find($id);

        return $admin->roles;
    }

    public function updateAdminRole(array $input, $id)
    {
        $id = $this->model::find($id);
        $this->model->storeAdminRole($id->id, $input);
    }
}
