<?php

namespace Library\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;

class ViewController extends Controller
{
    /**
     * Returns the corresponding view for the route
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $routeUri = $request->route()->uri;

        if(!View::exists('library::'.$routeUri)) {
            abort(404);
        }

        return view('library::'.$routeUri);
    }
}
