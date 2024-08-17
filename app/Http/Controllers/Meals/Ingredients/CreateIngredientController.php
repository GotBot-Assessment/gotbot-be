<?php

namespace App\Http\Controllers\Meals\Ingredients;

use App\Http\Controllers\Controller;
use App\Http\Requests\Meals\SaveIngredientRequest;
use App\Http\Resources\IngredientReource;
use App\Models\Meal;
use Illuminate\Http\Request;

class CreateIngredientController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Meal $food, SaveIngredientRequest $request) {
        $ingredient = $food->ingredients()
            ->create($request->validated());

        return new IngredientReource($ingredient);
    }
}
