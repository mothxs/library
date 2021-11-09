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
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function index(Request $request, string $view)
    {
        if(!View::exists('library::'.$view)) {
            abort(404);
        }

        return view('library::'.$view, ['view' => $view]);
    }
}
