<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use Illuminate\Http\Request;

class GetUserController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request) {
        return new UserResource($request->user());
    }
}
