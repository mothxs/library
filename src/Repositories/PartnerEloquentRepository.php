<?php

namespace Library\Repositories;

use Library\Models\PartnerModel;
use Library\Contracts\PartnerRepositoryInterface;

class PartnerEloquentRepository extends BaseEloquentRepository implements PartnerRepositoryInterface
{
    public function __construct(PartnerModel $model)
    {
        $this->model = $model;
    }
}
