<?php

namespace App\Http\Controllers\Foods;

use App\Http\Controllers\Controller;
use App\Http\Resources\FoodResource;
use App\Models\Food;

class ViewFoodController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Food $food) {
        return new FoodResource($food->load('ingredients'));
    }
}
