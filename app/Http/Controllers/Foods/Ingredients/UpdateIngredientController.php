<?php

namespace App\Http\Controllers\Foods\Ingredients;

use App\Http\Controllers\Controller;
use App\Http\Requests\Food\SaveIngredientRequest;
use App\Models\Food;
use App\Models\Ingredient;
use Symfony\Component\HttpFoundation\Response;

class UpdateIngredientController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Food $food, Ingredient $ingredient, SaveIngredientRequest $request) {
        if ($ingredient->foodId !== $food->id) {
            abort(Response::HTTP_FORBIDDEN, 'You can not update an ingredient that doesnt belong to this meal.');
        }

        $ingredient->update($request->validated());

        return $ingredient->fresh();
    }
}
