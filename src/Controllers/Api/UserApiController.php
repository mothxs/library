<?php

namespace Library\Controllers\Api;

use Library\Providers\UserProvider;
use Library\Persisters\UserPersister;
use Library\Controllers\Api\BaseApiController;

class UserApiController extends BaseApiController
{
    public function __construct(
        UserPersister $userPersister,
        UserProvider $userProvider
    ){
        $this->provider = $userProvider;
        $this->persister = $userPersister;
    }
}
