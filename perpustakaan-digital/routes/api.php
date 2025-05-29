<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\LoanController;
use App\Http\Controllers\BookAuthorController;

Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    
    Route::apiResource('user', UserController::class);
    
    Route::apiResource('book', BookController::class);
    
    Route::apiResource('author', AuthorController::class);
    
    Route::apiResource('loan', LoanController::class);

    Route::apiResource('book-autohor', BookAuthorController::class);

    
    // Route::post('loan/{loan}/return', [LoanController::class, 'returnBook']);
    // Route::get('loan/user/{user}', [LoanController::class, 'userLoans']);
    
    // Route::post('book/{book}/author', [BookAuthorController::class, 'attach']);
    // Route::delete('book/{book}/author/{author}', [BookAuthorController::class, 'detach']);
    
    // Route::get('book/search/{query}', [BookController::class, 'search']);
    // Route::get('author/search/{query}', [AuthorController::class, 'search']);
});