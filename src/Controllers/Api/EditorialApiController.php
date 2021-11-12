<?php

namespace Library\Controllers\Api;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Library\Providers\EditorialProvider;
use Library\Persisters\EditorialPersister;
use Library\Controllers\Api\BaseApiController;

class EditorialApiController extends BaseApiController
{
    protected $createValidationRules = [
        'name'            => 'required|string|unique:editorials',
        'country'         => 'required|string',
        'foundation_date' => 'nullable|date_format:Y-m-d',
        'website'         => 'nullable|string',
    ];

    protected $updateValidationRules = [
        'name'            => 'required|string|unique:editorials,name',
        'country'         => 'required|string',
        'foundation_date' => 'nullable|date_format:Y-m-d',
        'website'         => 'nullable|string',
    ];

    public function __construct(
        EditorialPersister $editorialPersister,
        EditorialProvider $editorialProvider
    ){
        $this->provider = $editorialProvider;
        $this->persister = $editorialPersister;
    }

    public function update(Request $request, $id)
    {
        $this->updateValidationRules['name'] .= ','.$id;

       return parent::update($request,$id);
    }
}
