<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\Review;
use App\Models\User;
use Illuminate\Database\Seeder;

class ReviewSeeder extends Seeder
{
    public function run(): void
    {
        $users = User::all();
        $books = Book::all();

        foreach ($users as $user) {
            $booksToReview = $books->random(rand(1,3));

            foreach ($booksToReview as $book) {
                Review::factory()->create([
                    'user_id' => $user->id,
                    'book_id' => $book->id,
                ]);
            }
        }
    }
}
