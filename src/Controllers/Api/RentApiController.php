<?php

namespace Library\Controllers\Api;

use Library\Providers\RentProvider;
use Library\Persisters\RentPersister;
use Library\Controllers\Api\BaseApiController;

class RentApiController extends BaseApiController
{
    public function __construct(
        RentPersister $rentPersister,
        RentProvider $rentProvider
    ){
        $this->provider = $rentProvider;
        $this->persister = $rentPersister;
    }
}
