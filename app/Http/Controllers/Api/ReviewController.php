<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ReviewResource;
use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{

    public function index()
    {
        return ReviewResource::collection(Review::all());
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'book_id' => 'required|exists:books,id',
            'review' => 'required|string|max:255',
            'rate' => 'required|integer|min:1|max:5',
        ]);

        return Review::create($validated);
    }

    public function update(Request $request, Review $review)
    {
        $validated = $request->validate([
            'review' => 'sometimes|string|max:255',
            'rate' => 'sometimes|integer|min:1|max:5',
        ]);

        $review->update($validated);
        return $review;
    }


    public function destroy(Review $review)
    {
        $review->delete();
        return response(status: 204);
    }
}
