<?php

namespace Library\Controllers\Api;

use Library\Providers\EditorialProvider;
use Library\Persisters\EditorialPersister;
use Library\Controllers\Api\BaseApiController;

class EditorialApiController extends BaseApiController
{
    public function __construct(
        EditorialPersister $editorialPersister,
        EditorialProvider $editorialProvider
    ){
        $this->provider = $editorialProvider;
        $this->persister = $editorialPersister;
    }
}
