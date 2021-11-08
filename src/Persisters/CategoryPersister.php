<?php

namespace Library\Persisters;

use Library\Persisters\BasePersister;
use Library\Contracts\CategoryRepositoryInterface;

class CategoryPersister extends BasePersister
{
    public function __construct(CategoryRepositoryInterface $repo)
    {
        $this->repo = $repo;
    }
}
