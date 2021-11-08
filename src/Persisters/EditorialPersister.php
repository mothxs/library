<?php

namespace Library\Persisters;

use Library\Persisters\BasePersister;
use Library\Contracts\EditorialRepositoryInterface;

class EditorialPersister extends BasePersister
{
    public function __construct(EditorialRepositoryInterface $repo)
    {
        $this->repo = $repo;
    }
}
