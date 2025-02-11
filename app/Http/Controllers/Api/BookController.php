<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\BookResource;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class BookController extends Controller
{


    public function __construct() {
        $this->middleware("auth:sanctum")->except(['index']);
    }


    public function index()
    {
        return BookResource::collection(Book::with('reviews')->get());
    }


    public function store(Request $request)
    {
        $book = Book::create([
            "user_id" => $request->user()->id,
            ...$request->validate([
                'title' => 'required|string|max:50',
                'author' => 'required|string|max:50',
                'release_year' => 'integer',
                'description' => 'string|max:255'
            ])
        ]);

        return new BookResource($book->load(['user', 'reviews']));
    }
    public function show(Book $book)
    {
        return new BookResource($book->load(['reviews']));
    }


    public function update(Request $request, Book $book)
    {


        $this->authorize('update-book', $book);

        $book->update($request->validate([
            'title' => 'sometimes|string|max:50',
            'author' => 'sometimes|string|max:50',
            'release_year' => 'integer',
            'description' => 'string|max:255'
        ]));

        return new BookResource($book->load(['user', 'reviews']));
    }

    public function destroy(Book $book)
    {

        $this->authorize('delete-book', $book);

        $book->delete();
        return response(status: 204);
    }
}
