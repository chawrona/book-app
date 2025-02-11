<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\Review;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ReviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $users = User::all();
        $books = Book::all();

        if ($books->isEmpty()) {
            $this->command->warn('No books found! Reviews not seeded.');
            return;
        }

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
