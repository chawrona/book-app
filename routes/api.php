<?php

use App\Http\Controllers\Api\BookController;
use App\Http\Controllers\Api\ReviewController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::apiResource('books',BookController::class);

Route::apiResource('books.reviews',ReviewController::class)
    ->scoped(['review' => 'book']);
