<?php

namespace Library\Controllers\Api;

use Library\Providers\BookProvider;
use Library\Persisters\BookPersister;
use Library\Controllers\Api\BaseApiController;

class BookApiController extends BaseApiController
{
    public function __construct(
        BookPersister $bookPersister,
        BookProvider $bookProvider
    ){
        $this->provider = $bookProvider;
        $this->persister = $bookPersister;
    }
}
