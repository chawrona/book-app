<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ReviewResource;
use App\Models\Book;
use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{

    public function index(Book $book)
    {
        $reviews = $book->reviews()->latest();

        return ReviewResource::collection($reviews->paginate(10));
    }


    public function store(Request $request, Book $book)
    {

        $review = $book->review()->create([
            'user_id' => 1,
            ...$request->validate([
                'review' => 'required|string|max:255',
                'rate' => 'required|integer|min:1|max:5',
            ])
        ]);

        return new ReviewResource($review);
    }

    public function show(Book $book, Review $review)    {
        return new ReviewResource($review);
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
