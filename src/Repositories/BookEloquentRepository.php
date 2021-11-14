<?php

namespace Library\Repositories;

use Library\Models\BookModel;
use Library\Contracts\BookRepositoryInterface;

class BookEloquentRepository extends BaseEloquentRepository implements BookRepositoryInterface
{
    protected $with = ['author', 'editorial', 'rents'];

    public function __construct(BookModel $model)
    {
        $this->model = $model;
    }
}
