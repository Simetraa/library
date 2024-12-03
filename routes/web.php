<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RegisteredUserController;
use App\Http\Controllers\SessionController;
use Illuminate\Support\Facades\Route;
use App\Models\Book;

Route::view('/welcome', 'welcome');

Route::controller(BookController::class)->group(function () {
    Route::get('/', 'catalogue');
    Route::get('/inventory', 'inventory');
    Route::post('/books', 'store');
    Route::get('/books/create', 'create');
    Route::get('/books/{book}',  'show');
    Route::get('/books/{book}/edit', 'edit');
    Route::patch('/books/{book}', 'update');
    Route::delete('/books/{book}', 'destroy');
});

Route::get('/register', [RegisteredUserController::class, 'create']);
Route::post('/register', [RegisteredUserController::class, 'store']);

Route::get('/login', [SessionController::class, 'create']);
Route::post('/login', [SessionController::class, 'store']);
Route::post('/logout', [SessionController::class, 'destroy']);

Route::get("/dashboard", [DashBoardController::class, 'index']);

Route::get('/account', function () {
    return view('account');
});
