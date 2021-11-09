<?php

namespace Library\Controllers\Api;

use Library\Providers\AuthorProvider;
use Library\Persisters\AuthorPersister;
use Library\Controllers\Api\BaseApiController;

class AuthorApiController extends BaseApiController
{
    public function __construct(
        AuthorPersister $authorPersister,
        AuthorProvider $authorProvider
    ){
        $this->provider = $authorProvider;
        $this->persister = $authorPersister;
    }
}
