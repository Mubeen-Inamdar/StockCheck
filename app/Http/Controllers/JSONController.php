<?php

namespace App\Http\Controllers;

use App\Support\DOMParser;
use Illuminate\Http\Request;
use App\Support\PhantomJSClient;

class JSONController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Load the sizes from the URL and return them.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function sizes(Request $request)
    {
        $dom   = PhantomJSClient::getDOMString($request->url);
        $stock = DOMParser::asos($dom);

        return response()->json($stock['allStock']);
    }
}
