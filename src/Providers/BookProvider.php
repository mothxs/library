<?php

namespace Library\Providers;

use Library\Contracts\BookRepositoryInterface;

class BookProvider extends BaseProvider
{
    public function __construct(BookRepositoryInterface $repo)
    {
        $this->repo = $repo;
    }
}
