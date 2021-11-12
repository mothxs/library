<?php

namespace Library\Controllers\Api;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Library\Providers\BookProvider;
use Library\Persisters\BookPersister;
use Library\Controllers\Api\BaseApiController;

class PartnerApiController extends BaseApiController
{
    protected $createValidationRules = [
        'name'      => 'required|string',
        'surname'   => 'required|string',
        'id_card'   => 'required|integer|unique:partners',
        'age'       => 'nullable|string',
        'address'   => 'nullable|string',
    ];

    protected $updateValidationRules = [
        'name'      => 'required|string',
        'surname'   => 'required|string',
        'id_card'   => 'required|integerunique:partners,id_card',
        'age'       => 'nullable|string',
        'address'   => 'nullable|string',
    ];

    public function __construct(
        BookPersister $bookPersister,
        BookProvider $bookProvider
    ){
        $this->provider = $bookProvider;
        $this->persister = $bookPersister;
    }

    public function update(Request $request, $id)
    {
        $this->updateValidationRules['id_card'] .= ','.$id;

       return parent::update($request,$id);
    }
}
