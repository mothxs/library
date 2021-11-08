<?php

namespace Library\Repositories;

use Library\Models\CategoryModel;
use Library\Contracts\CategoryRepositoryInterface;

class CategoryEloquentRepository extends BaseEloquentRepository implements CategoryRepositoryInterface
{
    public function __construct(CategoryModel $model)
    {
        $this->model = $model;
    }
}
