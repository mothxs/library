<?php

namespace Library\Persisters;

use Library\Contracts\BookRepositoryInterface;
use Library\Persisters\BasePersister;
use Library\Contracts\RentRepositoryInterface;

class RentPersister extends BasePersister
{
    public function __construct(
        RentRepositoryInterface $repo,
        BookRepositoryInterface $bookRepo
    ){
        $this->repo = $repo;
        $this->bookRepo = $bookRepo;
    }

    protected function canBeCreated(array $data): bool
    {
        $book = $this->bookRepo->find($data['book_id']);

        if($book->qty < $data['qty']) {
            return false;
        }

        return true;
    }
}
