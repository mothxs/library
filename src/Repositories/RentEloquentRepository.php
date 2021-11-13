<?php

namespace Library\Repositories;

use Library\Models\RentModel;
use Library\Contracts\RentRepositoryInterface;

class RentEloquentRepository extends BaseEloquentRepository implements RentRepositoryInterface
{
    protected $with = ['partner', 'book'];
    
    public function __construct(RentModel $model)
    {
        $this->model = $model;
    }
}
