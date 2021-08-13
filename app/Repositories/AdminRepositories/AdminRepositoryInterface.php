<?php

namespace App\Repositories\AdminRepositories;

use App\Repositories\RepositoryInterface;

interface AdminRepositoryInterface extends RepositoryInterface
{
    //ví dụ: lấy 5 sản phầm đầu tiên
    public function storeAdminRole(array $input);
    public function getListRole();
    public function getRoleAdmin($id);
    public function updateAdminRole(array $input, $id);
}
