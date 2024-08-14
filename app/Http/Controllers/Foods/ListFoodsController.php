<?php

namespace App\Http\Controllers\Foods;

use App\Http\Controllers\Controller;
use App\Http\Resources\FoodResource;
use App\Models\Food;
use Illuminate\Http\Request;

class ListFoodsController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request) {
        $foods = Food::withCount('ingredients')
            ->latest()
            ->paginate(15);

        return FoodResource::collection($foods);
    }
}
