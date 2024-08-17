<?php

namespace App\Http\Controllers\Meals;

use App\Http\Controllers\Controller;
use App\Http\Requests\Meals\SaveMealRequest;
use App\Http\Resources\MealResource;
use App\Models\Meal;
use Illuminate\Http\Request;

class UpdateMealController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Meal $food, SaveMealRequest $request) {
        $food->update($request->validated());

        return new MealResource($food->refresh());
    }
}
