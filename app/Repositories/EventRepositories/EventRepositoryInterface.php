<?php

namespace App\Repositories\EventRepositories;

use App\Repositories\RepositoryInterface;

interface EventRepositoryInterface extends RepositoryInterface
{
    //ví dụ: lấy 5 sản phầm đầu tiên
    public function storeEvent(array $data);
    public function updateEvent(array $data, $id);
}
