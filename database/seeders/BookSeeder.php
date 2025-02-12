<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\User;
use Illuminate\Database\Seeder;

class BookSeeder extends Seeder
{
    public function run(): void
    {
        $users = User::all();

        for ($i = 0; $i < 5; $i++) {
            $user = $users->random();
            Book::factory()->create(['user_id' => $user->id]);
        }
    }
}
