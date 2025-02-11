<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{

    public function index()
    {
        return Book::all();
    }


    public function store(Request $request)
    {
        $book = Book::create([
            ...$request->validate([
                'title' => 'required|string|max:50',
                'author' => 'required|string|max:50',
                'release_year' => 'integer',
                'description' => 'string|max:255'
            ])
        ]);

        return $book;
    }
    public function show(Book $book)
    {
        return $book;
    }


    public function update(Request $request, Book $book)
    {
        return $book->update($request->validate([
            'title' => 'somtimes|string|max:50',
            'author' => 'sometimes|string|max:50',
            'release_year' => 'integer',
            'description' => 'string|max:255'
        ]));
    }

    public function destroy(Book $book)
    {

        $book->delete();
        return response(status: 204);
    }
}
