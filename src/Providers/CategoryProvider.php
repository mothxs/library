<?php

namespace Library\Providers;

use Library\Contracts\CategoryRepositoryInterface;

class CategoryProvider extends BaseProvider
{
    public function __construct(CategoryRepositoryInterface $repo)
    {
        $this->repo = $repo;
    }
}
