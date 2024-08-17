<?php

namespace App\Http\Controllers\Meals;

use App\Http\Controllers\Controller;
use App\Models\Meal;
use Illuminate\Http\Request;

class DeleteMealController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Meal $food) {
        $food->delete();

        return response()->json([
            'message' => 'Food item deleted successfully.',
        ]);
    }
}
