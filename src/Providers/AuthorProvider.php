<?php

namespace Library\Providers;

use Library\Contracts\AuthorRepositoryInterface;

class AuthorProvider extends BaseProvider
{
    public function __construct(AuthorRepositoryInterface $repo)
    {
        $this->repo = $repo;
    }
}
