<?php

namespace Library\Controllers\Api;

use Library\Providers\CategoryProvider;
use Library\Persisters\CategoryPersister;
use Library\Controllers\Api\BaseApiController;

class CategoryApiController extends BaseApiController
{
    public function __construct(
        CategoryPersister $categoryPersister,
        CategoryProvider $categoryProvider
    ){
        $this->provider = $categoryProvider;
        $this->persister = $categoryPersister;
    }
}
