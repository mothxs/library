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
    
    protected function canBeCreated(array $data): bool
    {
        $exists = $this->repo->findByEmail($data['email']);

        if(!is_null($exists)) {
            return false;
        }

        return true;
    }
}
