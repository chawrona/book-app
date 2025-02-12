<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;

class ReviewResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
{
    return [
        'id' => $this->id,
        'user_id' =>  $this->user_id,
        'username' => $this->user->name,
        'book_id' => $this->book_id,
        'review' => $this->review,
        'rate' => $this->rate,
        'created_at' => $this->created_at,
        'is_owner' => tap(Auth::check() && Auth::id() === $this->user_id, function ($isOwner) {
            logger()->info('Auth ID: ' . Auth::id());
            logger()->info('User ID: ' . $this->user_id);
            logger()->info('Is Owner: ' . ($isOwner ? 'true' : 'false'));
        }),

    ];
}
}
