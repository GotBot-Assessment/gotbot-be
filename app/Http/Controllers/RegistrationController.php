<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Models\User;

class RegistrationController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(RegisterRequest $request) {
        $userData = $request->validated();
        $userData['password'] = bcrypt($userData['password']);

        $user = User::create($userData);
        $token = $user->createToken('Chef')->accessToken;

        return response()->json([
            'status' => 'success',
            'token'  => $token
        ]);
    }
}
