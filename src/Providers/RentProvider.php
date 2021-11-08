<?php

namespace Library\Providers;

use Library\Contracts\RentRepositoryInterface;

class RentProvider extends BaseProvider
{
    public function __construct(RentRepositoryInterface $repo)
    {
        $this->repo = $repo;
    }
}
