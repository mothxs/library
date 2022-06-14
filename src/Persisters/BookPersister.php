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

    /**
     * Validates wheter data can be deleted
     * 
     * @param array $data
     * @return bool
     */
    protected function canBeDeleted(int $id): bool
    {
        $book = $this->repo->find($id);

        if(is_null($book)) {
            return false;
        }

        if(count($book->rents) > 0) {
            return false;
        }
        
        return true;
    }
}
