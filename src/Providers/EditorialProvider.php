<?php

namespace Library\Providers;

use Library\Contracts\EditorialRepositoryInterface;

class EditorialProvider extends BaseProvider
{
    public function __construct(EditorialRepositoryInterface $repo)
    {
        $this->repo = $repo;
    }
}
