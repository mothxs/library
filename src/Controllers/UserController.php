<?php

namespace Library\Controllers;

use Library\Providers\UserProvider;
use Library\Persisters\UserPersister;

class UserController extends BaseController
{
    public function __construct(
        UserPersister $userPersister,
        UserProvider $userProvider
    ){
        $this->provider = $userProvider;
        $this->persister = $userPersister;
    }
}
