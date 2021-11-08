<?php

namespace Library\Repositories;

use Library\Models\EditorialModel;
use Library\Contracts\EditorialRepositoryInterface;

class EditorialEloquentRepository extends BaseEloquentRepository implements EditorialRepositoryInterface
{
    public function __construct(EditorialModel $model)
    {
        $this->model = $model;
    }
}
