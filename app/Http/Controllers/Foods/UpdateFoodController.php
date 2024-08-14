<?php

namespace App\Http\Controllers\Foods;

use App\Http\Controllers\Controller;
use App\Http\Requests\Food\SaveFoodRequest;
use App\Http\Resources\FoodResource;
use App\Models\Food;
use Illuminate\Http\Request;

class UpdateFoodController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Food $food, SaveFoodRequest $request) {
        $food->update($request->validated());

        return new FoodResource($food->refresh());
    }
}
