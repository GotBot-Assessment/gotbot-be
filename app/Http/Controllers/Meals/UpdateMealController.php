<?php

namespace App\Http\Controllers\Meals;

use App\Http\Controllers\Controller;
use App\Http\Requests\Food\SaveFoodRequest;
use App\Http\Resources\FoodResource;
use App\Models\Meal;
use Illuminate\Http\Request;

class UpdateMealController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Meal $food, SaveFoodRequest $request) {
        $food->update($request->validated());

        return new FoodResource($food->refresh());
    }
}
