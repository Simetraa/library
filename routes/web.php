<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PasswordController;
use App\Http\Controllers\RegisteredUserController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\SaleController;
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

Route::get('/login', [SessionController::class, 'create'])->name("login");
Route::post('/login', [SessionController::class, 'store']);
Route::post('/logout', [SessionController::class, 'destroy']);

Route::get("/dashboard", [DashBoardController::class, 'index']);

Route::put('/account/password', [PasswordController::class, 'update'])->middleware("auth");

Route::controller(RegisteredUserController::class)->group(function(){
    Route::patch('/account', 'update');
    Route::get('/account', 'show')->middleware("auth");
    Route::get('/register', 'create');
    Route::post('/register', 'store');
    Route::delete('/register', 'destroy')->name("account.destroy");
});

Route::controller(SaleController::class)->group(function(){
    Route::get('/account/purchases', 'index');
});

Route::controller(ReservationController::class)->group(function(){
    Route::post('/reservations', 'store');
    Route::get('/account/reservations', 'index')->middleware("auth");
    Route::delete('/reservations/{reservation}', 'destroy');
});

