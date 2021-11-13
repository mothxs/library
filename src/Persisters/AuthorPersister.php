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

    protected function canBeDeleted(int $id): bool
    {
        $author = $this->repo->find($id);

        if(!$author) {
            return false;
        }

        if(count($author->books) > 0) {
            return false;
        }

        return true;
    }
}
