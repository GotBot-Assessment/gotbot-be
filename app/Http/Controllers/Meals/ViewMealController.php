<?php

namespace App\Http\Controllers\Meals;

use App\Http\Controllers\Controller;
use App\Http\Resources\MealResource;
use App\Models\Meal;

class ViewMealController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Meal $food) {
        return new MealResource($food->load(['ingredients', 'media']));
    }
}
