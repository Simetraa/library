<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\BranchController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\PasswordController;
use App\Http\Controllers\RegisteredUserController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\StaffReservationController;
use App\Http\Controllers\StaffSalesController;
use Illuminate\Support\Facades\Route;

Route::view('/welcome', 'welcome');

Route::controller(BookController::class)->group(function () {
    Route::get('/', 'catalogue');
    Route::get('/books', 'index');
    Route::post('/books', 'store');
    Route::get('/books/create', 'create');
    Route::get('/books/{book}',  'show');
    Route::get('/books/{book}/edit', 'edit');
    Route::patch('/books/{book}', 'update');
    Route::patch('/books/{book}/toggleVisibility', 'toggleVisibility');
});

Route::get('/login', [SessionController::class, 'create'])->name("login");
Route::post('/login', [SessionController::class, 'store']);
Route::post('/logout', [SessionController::class, 'destroy']);

Route::put('/account/password', [PasswordController::class, 'update'])->middleware("auth");

Route::controller(RegisteredUserController::class)->group(function(){
    Route::patch('/account', 'update');
    Route::get('/account', 'show')->middleware("auth");
    Route::get('/register', 'create');
    Route::post('/register', 'store');
    Route::delete('/register', 'destroy')->name("account.destroy");
});

Route::controller(StaffController::class)->group(function(){
    Route::get('/branches/{branch}/staff', 'index');
    Route::get('/branches/{branch}/staff/create', 'create');
    Route::get('/branches/{branch}/staff/{user}', 'show');
    Route::get('/branches/{branch}/staff/{user}/edit', 'edit');
    Route::patch('/branches/{branch}/staff/{user}', 'update');
});

Route::controller(SaleController::class)->group(function(){
    Route::get('/account/purchases', 'index')->middleware("auth");
});

Route::controller(ReservationController::class)->group(function(){
    Route::post('/reservations', 'store');
    Route::get('/account/reservations', 'index')->middleware("auth");
    Route::delete('/reservations/{reservation}', 'destroy');
});

Route::controller(StaffReservationController::class)->group(function(){
    Route::get('/branches/{branch}/reservations', 'index');
    Route::post('/reservations/{reservation}', 'fulfil');
});

Route::controller(BranchController::class)->group(function(){
    Route::get('/branches', 'index');
    Route::get('/branches/create', 'create');
    Route::post('/branches', 'store');
    Route::delete('/branches/{branch}', 'destroy');
    Route::get('/branches/{branch}',  'show');
    Route::get('/branches/{branch}/edit', 'edit');
    Route::patch('/branches/{branch}', 'update');
});

Route::controller(InventoryController::class)->group(function(){
    Route::get('/branches/{branch}/inventory', 'index');
    Route::delete('/branches/{branch}/inventory/{book}', 'destroy');
});

Route::controller(StaffSalesController::class)->group(function(){
    Route::get('/branches/{branch}/sales', 'index');
    Route::get('/branches/{branch}/sales/create', 'create');
    Route::get('/branches/{branch}/sales/{sale}', 'show');
});
