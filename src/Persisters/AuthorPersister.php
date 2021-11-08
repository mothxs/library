<?php

namespace Library\Persisters;

use Library\Persisters\BasePersister;
use Library\Contracts\AuthorRepositoryInterface;

class AuthorPersister extends BasePersister
{
    public function __construct(AuthorRepositoryInterface $repo)
    {
        $this->repo = $repo;
    }
}
