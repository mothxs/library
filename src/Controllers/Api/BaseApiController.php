<?php

namespace Library\Controllers\Api;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Log;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class BaseApiController extends Controller
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * The persister class
     * 
     */
    protected $persister;

    /**
     * The provider class
     * 
     */
    protected $provider;
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $data = $this->provider->all();
        } catch(Exception $e) {
            Log::warning('Error listing the resources. '.$e->getMessage());
            return response()->json(['error' => 'Error listing the resources.']);
        }

        return response()->json($data);
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
            Log::warning('Error listing the resources. '.$e->getMessage());
            return response()->json(['error' => 'Error creating a new resource.']);
        }

        if(!$item) {
            return response()->json($item, 422);
        }

        return response()->json($item, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $item = $this->provider->find($id);
        } catch(Exception $e) {
            Log::warning('Error finding the resource with the id '.$id.'. '.$e->getMessage());
            return response()->json(['error' => 'Error finding the resource with the id '.$id.'.']);
        }

        if(empty($item)) {
            return response()->json([], 404);
        }

        return response()->json($item);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate($this->updateValidationRules);

        try {
            $item = $this->provider->update($id, $validatedData);
        } catch(Exception $e) {
            Log::warning('Error updating the resource with the id '.$id.'. '.$e->getMessage());
            return response()->json(['error' => 'Error updating the resource with the id '.$id.'.']);
        }

        if(empty($item)) {
            return response()->json([], 404);
        }

        return response()->json($item);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $deleted = $this->provider->archive($id);
        } catch(Exception $e) {
            Log::warning('Error deleting the resource with the id '.$id.'. '.$e->getMessage());
            return response()->json(['error' => 'Error deleting the resource with the id '.$id.'.']);
        }

        if(!$deleted) {
            return response()->json([], 422);
        }

        return response()->json();
    }
}
