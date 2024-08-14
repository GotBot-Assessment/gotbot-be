<?php

namespace App\Http\Controllers\Foods;

use App\Http\Controllers\Controller;
use App\Http\Requests\Food\SaveFoodRequest;
use App\Http\Resources\FoodResource;
use App\Models\Food;

class CreateFoodController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(SaveFoodRequest $request) {
        $food = Food::create($request->validated());

        return new FoodResource($food);
    }
}
