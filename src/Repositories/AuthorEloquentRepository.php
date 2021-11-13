<?php

namespace Library\Repositories;

use Library\Models\AuthorModel;
use Library\Contracts\AuthorRepositoryInterface;

class AuthorEloquentRepository extends BaseEloquentRepository implements AuthorRepositoryInterface
{
    protected $with = ['books'];

    public function __construct(AuthorModel $model)
    {
        $this->model = $model;
    }
}
