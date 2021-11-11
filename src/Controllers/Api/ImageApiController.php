<?php

namespace Library\Controllers\Api;

use Exception;
use Illuminate\Http\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class ImageApiController extends Controller
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function store(Request $request)
    {
        $validated = $request->validate([
            'file' => 'required|image|max:1024'
        ]);

        try {
            $path = Storage::putFile('public/images', new File($validated['file']->getPathname()));
            $splitedName = explode('/', $path);
            $splitedName[0] = 'storage';
            $realName = implode('/', $splitedName);
        }catch(Exception $e) {
            Log::error('Error uploading image.' . $e->getMessage());
            return response()->json(['error' => 'Error uploading image']);
        }
        
        return response()->json(['name' => $realName]);
    }
}
