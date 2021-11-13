<?php

namespace Library\Controllers\Api;

use Illuminate\Http\Request;
use Library\Providers\PartnerProvider;
use Library\Persisters\PartnerPersister;
use Library\Controllers\Api\BaseApiController;

class PartnerApiController extends BaseApiController
{
    protected $createValidationRules = [
        'name'       => 'required|string',
        'surname'    => 'required|string',
        'id_card'    => 'required|string|size:9|unique:partners',
        'birth_date' => 'nullable|date_format:Y-m-d',
        'address'    => 'required|string',
    ];

    protected $updateValidationRules = [
        'name'       => 'required|string',
        'surname'    => 'required|string',
        'id_card'    => 'required|string|size:9|unique:partners,id_card',
        'birth_date' => 'nullable|date_format:Y-m-d',
        'address'    => 'required|string',
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
