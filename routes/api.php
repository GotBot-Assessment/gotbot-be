<?php

use App\Http\Controllers\Authentication\LoginController;
use App\Http\Controllers\Authentication\LogoutController;
use App\Http\Controllers\Authentication\RegistrationController;
use App\Http\Controllers\Meals\CreateMealController;
use App\Http\Controllers\Meals\DeleteMealController;
use App\Http\Controllers\Meals\Ingredients\CreateIngredientController;
use App\Http\Controllers\Meals\Ingredients\DeleteIngredientController;
use App\Http\Controllers\Meals\Ingredients\UpdateIngredientController;
use App\Http\Controllers\Meals\ListMealsController;
use App\Http\Controllers\Meals\UpdateMealController;
use App\Http\Controllers\Meals\UploadMealPictureController;
use App\Http\Controllers\Meals\ViewMealController;
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

Route::prefix('meals')
    ->middleware(['auth:api'])
    ->group(callback: function () {
        Route::get('/', ListMealsController::class);
        Route::post('/', CreateMealController::class);
        Route::get('/{meal}', ViewMealController::class);
        Route::post('/{meal}', UploadMealPictureController::class);
        Route::delete('/{meal}', DeleteMealController::class);
        Route::put('/{meal}', UpdateMealController::class);

        //Ingredients.
        Route::post('/{meal}/ingredients', CreateIngredientController::class);
        Route::delete('/{meal}/ingredients/{ingredient}', DeleteIngredientController::class);
        Route::put('/{meal}/ingredients/{ingredient}', UpdateIngredientController::class);
    });
