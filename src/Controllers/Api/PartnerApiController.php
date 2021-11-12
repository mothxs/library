<?php

namespace Library\Controllers\Api;

use Illuminate\Http\Request;
use Library\Providers\PartnerProvider;
use Library\Persisters\PartnerPersister;
use Library\Controllers\Api\BaseApiController;

class PartnerApiController extends BaseApiController
{
    protected $createValidationRules = [
        'name'      => 'required|string',
        'surname'   => 'required|string',
        'id_card'   => 'required|string|unique:partners',
        'age'       => 'nullable|string',
        'address'   => 'nullable|string',
    ];

    protected $updateValidationRules = [
        'name'      => 'required|string',
        'surname'   => 'required|string',
        'id_card'   => 'required|string|unique:partners,id_card',
        'age'       => 'nullable|string',
        'address'   => 'nullable|string',
    ];

    public function __construct(
        PartnerPersister $partnerPersister,
        PartnerProvider $partnerProvider
    ){
        $this->provider = $partnerProvider;
        $this->persister = $partnerPersister;
    }

    public function update(Request $request, $id)
    {
        $this->updateValidationRules['id_card'] .= ','.$id;

       return parent::update($request,$id);
    }
}
