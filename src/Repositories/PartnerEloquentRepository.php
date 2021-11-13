<?php

namespace Library\Repositories;

use Library\Models\PartnerModel;
use Library\Contracts\PartnerRepositoryInterface;

class PartnerEloquentRepository extends BaseEloquentRepository implements PartnerRepositoryInterface
{
    protected $with = ['rents'];

    public function __construct(PartnerModel $model)
    {
        $this->model = $model;
    }
}
