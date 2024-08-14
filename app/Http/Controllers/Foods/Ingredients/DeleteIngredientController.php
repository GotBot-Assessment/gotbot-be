<?php

namespace App\Http\Controllers\Foods\Ingredients;

use App\Http\Controllers\Controller;
use App\Models\Food;
use App\Models\Ingredient;
use Symfony\Component\HttpFoundation\Response;

class DeleteIngredientController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Food $food, Ingredient $ingredient) {
        if ($ingredient->foodId !== $food->id) {
            abort(Response::HTTP_FORBIDDEN, 'You can not delete an ingredient that doesnt belong to this meal.');
        }

        $ingredient->delete();

        return response([
            'message' => 'Ingredient deleted successfully.'
        ]);
    }
}
