<?php

namespace App\Repositories\UserRepositories;

use App\Repositories\UserRepositories\UserRepositoryInterface;

use App\Repositories\BaseRepository;

class UserRepository extends BaseRepository implements UserRepositoryInterface
{
    //lấy model tương ứng
    public function getModel()
    {
        return \App\Models\User::class;
    }
}
