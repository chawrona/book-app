<?php

namespace App\Providers;

use App\Models\Book;
use App\Models\Review;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{

    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        $bookPolicy = fn($user, Book $book) => $user->id === $book->user_id;
        $reviewPolicy = fn($user, Book $book, Review $review) => $user->id === $review->user_id;

        Gate::define('update-book', $bookPolicy);
        Gate::define('delete-book', $bookPolicy);
        Gate::define('update-review', $reviewPolicy);
        Gate::define('delete-review', $reviewPolicy);
    }
}
