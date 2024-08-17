<?php

namespace App\Http\Controllers\Meals;

use App\Http\Controllers\Controller;
use App\Http\Requests\Food\SaveFoodRequest;
use App\Http\Resources\FoodResource;
use App\Models\Meal;

class CreateMealController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(SaveFoodRequest $request) {
        $food = Meal::create($request->validated());

        return new FoodResource($food);
    }
}
