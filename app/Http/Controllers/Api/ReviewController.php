<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ReviewResource;
use App\Models\Book;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class ReviewController extends Controller
{

    public function __construct() {
        $this->middleware("auth:sanctum")->except(['index', 'show']);
    }

    public function index(Book $book)
    {
        $reviews = $book->reviews()->latest();

        return ReviewResource::collection($reviews);
    }


    public function store(Request $request, Book $book)
    {

        $review = $book->reviews()->create([
            "user_id" => $request->user()->id,
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

    public function update(Request $request, Book $book, Review $review)
    {
        $this->authorize('update-review', $review);

        $validated = $request->validate([
            'review' => 'sometimes|string|max:255',
            'rate' => 'sometimes|integer|min:1|max:5',
        ]);

        $review->update($validated);
        return new ReviewResource($review);
    }


    public function destroy(string $book, Review $review)
    {
        $this->authorize('delete-review', $review);
        $review->delete();
        return response(status: 204);
    }
}
