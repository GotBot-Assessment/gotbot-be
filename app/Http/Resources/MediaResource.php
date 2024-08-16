<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MediaResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array {
        return [
            'id'             => $this->id,
            'collectionName' => $this->collection_name,
            'url'            => $this->getFullUrl(),
            'createdAt'      => $this->created_at,
            'updatedAt'      => $this->updated_at,
        ];
    }
}
