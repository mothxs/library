<?php

namespace Library\Persisters;

use Library\Persisters\BasePersister;
use Library\Contracts\BookRepositoryInterface;

class BookPersister extends BasePersister
{
    public function __construct(BookRepositoryInterface $repo)
    {
        $this->repo = $repo;
    }
}
