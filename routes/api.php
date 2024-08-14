<?php

use App\Http\Controllers\Authentication\LoginController;
use App\Http\Controllers\Authentication\RegistrationController;
use App\Http\Controllers\Foods\ListFoodsController;
use App\Http\Controllers\Foods\ViewFoodController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');

Route::prefix('auth')->group(function () {
    Route::post('/register', RegistrationController::class);
    Route::post('/login', LoginController::class);
});

Route::prefix('foods')
    ->middleware(['auth:api'])
    ->group(callback: function () {
        Route::get('/', ListFoodsController::class);
        Route::get('/{id}', ViewFoodController::class);
    });
