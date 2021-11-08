<?php

namespace Library\Repositories;

use App\Models\User as UserModel;
use Library\Contracts\UserRepositoryInterface;

class UserEloquentRepository extends BaseEloquentRepository implements UserRepositoryInterface
{
    public function __construct(UserModel $model)
    {
        $this->model = $model;
    }
}
