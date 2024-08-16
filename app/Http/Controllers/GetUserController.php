<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GetUserController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request) {
        return $request->user();
    }
}
