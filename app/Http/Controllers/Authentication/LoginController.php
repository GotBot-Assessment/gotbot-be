<?php

namespace App\Http\Controllers\Authentication;

use App\Http\Controllers\Controller;
use App\Http\Requests\Authentication\LoginRequest;
use Symfony\Component\HttpFoundation\Response;

class LoginController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(LoginRequest $request) {
        if (auth()->attempt($request->validated())) {
            $user = auth()->user();
            $token = $user->createToken('Chef')->accessToken;
            return response()->json([
                'status' => 'success',
                'token'  => $token
            ]);
        }

        abort(Response::HTTP_UNPROCESSABLE_ENTITY, 'Invalid login credentials');
    }
}
