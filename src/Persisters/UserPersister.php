<?php

namespace Library\Persisters;

use Library\Persisters\BasePersister;
use Library\UserRepositoryInterface;

class UserPersister extends BasePersister
{
    protected $repo = UserRepositoryInterface::class;
}
