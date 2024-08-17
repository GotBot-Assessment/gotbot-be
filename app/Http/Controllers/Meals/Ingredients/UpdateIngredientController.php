<?php

namespace App\Http\Controllers\Meals\Ingredients;

use App\Http\Controllers\Controller;
use App\Http\Requests\Meals\SaveIngredientRequest;
use App\Models\Meal;
use App\Models\Ingredient;
use Symfony\Component\HttpFoundation\Response;

class UpdateIngredientController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Meal $meal, Ingredient $ingredient, SaveIngredientRequest $request) {
        if ($ingredient->mealId !== $meal->id) {
            abort(Response::HTTP_FORBIDDEN, 'You can not update an ingredient that doesnt belong to this meal.');
        }

        $ingredient->update($request->validated());

        return $ingredient->fresh();
    }
}
