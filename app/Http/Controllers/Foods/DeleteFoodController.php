<?php

namespace App\Http\Controllers\Foods;

use App\Http\Controllers\Controller;
use App\Models\Food;
use Illuminate\Http\Request;

class DeleteFoodController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Food $food) {
        $food->delete();

        return response()->json([
            'message' => 'Food item deleted successfully.',
        ]);
    }
}
