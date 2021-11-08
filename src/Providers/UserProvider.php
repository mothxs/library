<?php

namespace Library\Providers;

use Library\Contracts\UserRepositoryInterface;

class UserProvider extends BaseProvider
{
    public function __construct(UserRepositoryInterface $repo)
    {
        $this->repo = $repo;
    }
}
