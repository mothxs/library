<?php

namespace Library\Contracts;

use Library\Contracts\BaseRepositoryInterface;

interface UserRepositoryInterface extends BaseRepositoryInterface
{
    /**
     * Finds the user by email
     * 
     * @param string $email
     * @return object|null
     */
    public function findByEmail(string $email): object|null;
}
