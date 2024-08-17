<?php

namespace App\Http\Controllers\Meals;

use App\Http\Controllers\Controller;
use App\Http\Requests\Meals\UploadPictureRequest;
use App\Http\Resources\MealResource;
use App\Models\Meal;
use Illuminate\Http\Request;

class UploadMealPictureController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Meal $meal, UploadPictureRequest $request) {
        $meal->addMediaFromRequest('image')
            ->toMediaCollection('meal');

        return new MealResource($meal->with(['media'])->first());
    }
}
