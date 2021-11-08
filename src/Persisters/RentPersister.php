<?php

namespace Library\Persisters;

use Library\Persisters\BasePersister;
use Library\Contracts\RentRepositoryInterface;

class RentPersister extends BasePersister
{
    public function __construct(RentRepositoryInterface $repo)
    {
        $this->repo = $repo;
    }
}
