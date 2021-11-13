<?php

namespace Library\Controllers\Api;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate($this->createValidationRules);

        try {
            $item = $this->persister->insert($validatedData);
        } catch(Exception $e) {
            Log::error('Error creating a new resource. '.$e->getMessage());
            return response()->json(['error' => 'Error creating a new resource.'], 500);
        }

        if(!$item) {
            return response()->json([], 422);
        }

        return response()->json($item, 201);
    }
}
