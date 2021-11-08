<?php

namespace Library\Persisters;

use Library\Persisters\BasePersister;
use Library\Contracts\UserRepositoryInterface;

class UserPersister extends BasePersister
{
    public function __construct(UserRepositoryInterface $repo)
    {
        $this->repo = $repo;
    }
}
