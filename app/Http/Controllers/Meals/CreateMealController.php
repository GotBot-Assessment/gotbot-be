<?php

namespace App\Http\Controllers\Meals;

use App\Http\Controllers\Controller;
use App\Http\Requests\Meals\SaveMealRequest;
use App\Http\Resources\MealResource;
use App\Models\Meal;

class CreateMealController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(SaveMealRequest $request) {
        $meal = Meal::create($request->validated());

        return new MealResource($meal);
    }
}
