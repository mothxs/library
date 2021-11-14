<?php

namespace Library\Controllers\Api;

use Library\Providers\RentProvider;
use Library\Persisters\RentPersister;
use Library\Controllers\Api\BaseApiController;

class RentApiController extends BaseApiController
{
    protected $createValidationRules = [
        'book_id'         => 'required|int|exists:books,id',
        'partner_id'      => 'required|int|exists:partners,id',
        'start_date'      => 'required|date_format:Y-m-d',
        'end_date'        => 'required|date_format:Y-m-d|after:start_date',
        'qty'             => 'required|int|min:1'
    ];

    protected $updateValidationRules = [
        'end_date'        => 'required|date_format:Y-m-d',
        'times_extended'  => 'required|integer|max:4'
    ];

    public function __construct(
        RentPersister $rentPersister,
        RentProvider $rentProvider
    ){
        $this->provider = $rentProvider;
        $this->persister = $rentPersister;
    }
}
