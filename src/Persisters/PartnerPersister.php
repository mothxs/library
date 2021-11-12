<?php

namespace Library\Persisters;

use Library\Persisters\BasePersister;
use Library\Contracts\PartnerRepositoryInterface;

class PartnerPersister extends BasePersister
{
    public function __construct(PartnerRepositoryInterface $repo)
    {
        $this->repo = $repo;
    }
}
