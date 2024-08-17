<?php

namespace App\Http\Controllers\Meals\Ingredients;

use App\Http\Controllers\Controller;
use App\Models\Meal;
use App\Models\Ingredient;
use Symfony\Component\HttpFoundation\Response;

class DeleteIngredientController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Meal $food, Ingredient $ingredient) {
        if ($ingredient->foodId !== $food->id) {
            abort(Response::HTTP_FORBIDDEN, 'You can not delete an ingredient that doesnt belong to this meal.');
        }

        $ingredient->delete();

        return response([
            'message' => 'Ingredient deleted successfully.'
        ]);
    }
}
