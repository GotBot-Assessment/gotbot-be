<?php

namespace App\Http\Controllers\Meals;

use App\Http\Controllers\Controller;
use App\Http\Requests\Food\UploadPictureRequest;
use App\Http\Resources\FoodResource;
use App\Models\Meal;
use Illuminate\Http\Request;

class UploadMealPictureController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Meal $food, UploadPictureRequest $request) {
        $food->addMediaFromRequest('image')
            ->toMediaCollection('food');

        return new FoodResource($food->with(['media'])->first());
    }
}
