<?php

namespace App\Http\Controllers\Authentication;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LogoutController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request) {
        $request->user()->token()->revoke();

        return response()->json([
            'status'  => 'success',
            'message' => 'Successfully logged out'
        ]);
    }
}
