<?php

namespace App\Http\Controllers\Meals;

use App\Http\Controllers\Controller;
use App\Http\Resources\MealResource;
use App\Models\Meal;
use Illuminate\Http\Request;

class ListMealsController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request) {
        $foods = Meal::withCount(['ingredients', 'media'])
            ->latest()
            ->paginate(12);

        return MealResource::collection($foods);
    }
}
