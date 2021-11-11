<?php

namespace Library\Controllers\Api;

use Library\Providers\AuthorProvider;
use Library\Persisters\AuthorPersister;
use Library\Controllers\Api\BaseApiController;

class AuthorApiController extends BaseApiController
{
    protected $createValidationRules = [
        'name'       => 'required|string',
        'surname'    => 'nullable|string',
        'country'    => 'nullable|string',
        'language'   => 'nullable|string',
        'birth_date' => 'nullable|date_format:Y-m-d'
    ];

    protected $updateValidationRules = [
        'name'       => 'required|string',
        'surname'    => 'nullable|string',
        'country'    => 'nullable|string',
        'language'   => 'nullable|string',
        'birth_date' => 'nullable|date_format:Y-m-d'
    ];

    public function __construct(
        AuthorPersister $authorPersister,
        AuthorProvider $authorProvider
    ){
        $this->provider = $authorProvider;
        $this->persister = $authorPersister;
    }
}
