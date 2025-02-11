<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;


class BookResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "id" => $this->id,
            "title" => $this->title,
            "release_year" => $this->release_year,
            "author" => $this->author,
            "description" => $this->description,
            "user" => new UserResource($this->whenLoaded("user")),
            "reviews" => ReviewResource::collection($this->whenLoaded("reviews")),
        ];
    }
}
