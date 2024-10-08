<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MealResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array {
        return [
            'id'               => $this->id,
            'name'             => $this->name,
            'description'      => $this->description,
            'category'         => $this->category,
            'area'             => $this->area,
            'price'            => $this->price,
            'createdAt'        => $this->created_at,
            'updatedAt'        => $this->updated_at,
            'image'            => $this->whenLoaded('media', new MediaResource($this->getFirstMedia('meal'))),
            'ingredients'      => $this->whenLoaded('ingredients', IngredientReource::collection($this->ingredients)),
            'ingredientsCount' => $this->whenCounted('ingredients', $this->ingredientsCount)
        ];
    }
}
