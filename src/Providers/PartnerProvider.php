<?php

namespace Library\Providers;

use Library\Contracts\PartnerRepositoryInterface;

class PartnerProvider extends BaseProvider
{
    public function __construct(PartnerRepositoryInterface $repo)
    {
        $this->repo = $repo;
    }
}
