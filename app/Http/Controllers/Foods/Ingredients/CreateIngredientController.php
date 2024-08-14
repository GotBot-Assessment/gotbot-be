<?php

namespace App\Http\Controllers\Foods\Ingredients;

use App\Http\Controllers\Controller;
use App\Http\Requests\Food\SaveIngredientRequest;
use App\Http\Resources\IngredientReource;
use App\Models\Food;
use Illuminate\Http\Request;

class CreateIngredientController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Food $food, SaveIngredientRequest $request) {
        $ingredient = $food->ingredients()
            ->create($request->validated());

        return new IngredientReource($ingredient);
    }
}
