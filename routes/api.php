<?php

use App\Http\Controllers\Authentication\LoginController;
use App\Http\Controllers\Authentication\LogoutController;
use App\Http\Controllers\Authentication\RegistrationController;
use App\Http\Controllers\Foods\CreateFoodController;
use App\Http\Controllers\Foods\DeleteFoodController;
use App\Http\Controllers\Foods\Ingredients\CreateIngredientController;
use App\Http\Controllers\Foods\Ingredients\DeleteIngredientController;
use App\Http\Controllers\Foods\Ingredients\UpdateIngredientController;
use App\Http\Controllers\Foods\ListFoodsController;
use App\Http\Controllers\Foods\UpdateFoodController;
use App\Http\Controllers\Foods\UploadFoodPictureController;
use App\Http\Controllers\Foods\ViewFoodController;
use App\Http\Controllers\GetUserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');

Route::prefix('auth')->group(function () {
    Route::post('/register', RegistrationController::class);
    Route::post('/login', LoginController::class);
});

//get user profile.
Route::middleware('auth:api')
    ->group(function () {
        Route::get('/user', GetUserController::class);
        Route::get('/auth/logout', LogoutController::class);
    });

Route::prefix('foods')
    ->middleware(['auth:api'])
    ->group(callback: function () {
        Route::get('/', ListFoodsController::class);
        Route::post('/', CreateFoodController::class);
        Route::get('/{food}', ViewFoodController::class);
        Route::post('/{food}', UploadFoodPictureController::class);
        Route::delete('/{food}', DeleteFoodController::class);
        Route::put('/{food}', UpdateFoodController::class);

        //Ingredients.
        Route::post('/{food}/ingredients', CreateIngredientController::class);
        Route::delete('/{food}/ingredients/{ingredient}', DeleteIngredientController::class);
        Route::put('/{food}/ingredients/{ingredient}', UpdateIngredientController::class);
    });
