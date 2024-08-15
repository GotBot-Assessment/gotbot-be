<?php

namespace App\Http\Controllers\Foods;

use App\Http\Controllers\Controller;
use App\Http\Requests\Food\UploadPictureRequest;
use App\Http\Resources\FoodResource;
use App\Models\Food;
use Illuminate\Http\Request;

class UploadFoodPictureController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Food $food, UploadPictureRequest $request) {
        $food->addMediaFromRequest('image')
            ->toMediaCollection('food');

        return new FoodResource($food->with(['media'])->first());
    }
}
