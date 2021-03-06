<?php

namespace Library\Controllers\Api;

use Library\Providers\BookProvider;
use Library\Persisters\BookPersister;
use Library\Controllers\Api\BaseApiController;

class BookApiController extends BaseApiController
{
    protected $createValidationRules = [
        'title'            => 'required|string',
        'isbn'             => 'required|string',
        'pages'            => 'required|integer|min:1',
        'author_id'        => 'required|integer|exists:authors,id',
        'editorial_id'     => 'required|integer|exists:editorials,id',
        'category'         => 'nullable|string',
        'cover_type'       => 'nullable|string',
        'copyright'        => 'nullable|string',
        'publishing_place' => 'nullable|string',
        'release_date'     => 'nullable|date_format:Y-m-d',
        'qty'              => 'required|integer|min:0',
        'image'            => 'nullable|string'
    ];

    protected $updateValidationRules = [
        'title'            => 'required|string',
        'isbn'             => 'required|string',
        'pages'            => 'required|integer|min:1',
        'author_id'        => 'required|integer|exists:authors,id',
        'editorial_id'     => 'required|integer|exists:editorials,id',
        'category'         => 'nullable|string',
        'cover_type'       => 'nullable|string',
        'copyright'        => 'nullable|string',
        'publishing_place' => 'nullable|string',
        'release_date'     => 'nullable|date_format:Y-m-d',
        'qty'              => 'required|integer|min:0',
        'image'            => 'nullable|string'
    ];

    public function __construct(
        BookPersister $bookPersister,
        BookProvider $bookProvider
    ){
        $this->provider = $bookProvider;
        $this->persister = $bookPersister;
    }
}
