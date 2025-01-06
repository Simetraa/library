<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\BranchController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\PasswordController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\RegisteredUserController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\StaffPasswordController;
use App\Http\Controllers\StaffReservationController;
use App\Http\Controllers\StaffSalesController;
use App\Models\User;
use Illuminate\Support\Facades\Route;

Route::view('/welcome', 'welcome');

Route::controller(BookController::class)->group(function () {
    Route::get('/', 'catalogue');
    Route::post('/books/autofill', 'autofill')->middleware('can:access-staff-and-admin-pages');
    Route::get('/books', 'index')->middleware('can:access-staff-and-admin-pages');
    Route::post('/books', 'store')->middleware('can:access-staff-and-admin-pages');
    Route::get('/books/create', 'create')->middleware('can:access-staff-and-admin-pages');
    Route::get('/books/{book}',  'show');
    Route::get('/books/{book}/edit', 'edit')->middleware('can:access-staff-and-admin-pages');
    Route::patch('/books/{book}', 'update')->middleware('can:access-staff-and-admin-pages');
    Route::patch('/books/{book}/toggleVisibility', 'toggleVisibility')->middleware('can:access-staff-and-admin-pages');
});

Route::get('/login', [SessionController::class, 'create'])->name("login");
Route::post('/login', [SessionController::class, 'store']);
Route::post('/logout', [SessionController::class, 'destroy']);

Route::put('/account/password', [PasswordController::class, 'update'])->middleware("can:access-user-pages");

Route::controller(RegisteredUserController::class)->group(function(){
    Route::patch('/account', 'update')->middleware("can:access-user-pages");
    Route::get('/account', 'show')->middleware("can:access-user-pages");
    Route::get('/register', 'create');
    Route::post('/register', 'store');
    Route::delete('/register', 'destroy')->name("account.destroy")->middleware("can:access-user-pages");
});

Route::controller(StaffController::class)->group(function(){
    Route::get('/branches/{branch}/staff', 'index')->middleware('can:access-admin-pages');
    Route::get('/branches/{branch}/staff/create', 'create')->middleware('can:access-admin-pages');
    Route::post('/branches/{branch}/staff', 'store')->middleware('can:access-admin-pages');
//    Route::get('/branches/{branch}/staff/{user}', 'show')->middleware('can:access-staff-account-page');
    Route::get('/branches/{branch}/staff/{user}/edit', 'edit')->can('access-staff-account-page', User::class);
    Route::patch('/branches/{branch}/staff/{user}', 'update')->middleware('can:access-admin-pages');
    Route::delete('/branches/{branch}/staff/{user}', 'destroy')->middleware('can:access-admin-pages');
});

Route::put('/branches/{branch}/staff/{user}/password', [StaffPasswordController::class, 'update'])->middleware('can:access-staff-account-page');

Route::controller(SaleController::class)->group(function(){
    Route::get('/account/purchases', 'index')->middleware('can:access-user-pages');
});

Route::controller(ReservationController::class)->group(function(){
    Route::post('/reservations', 'store')->middleware('can:access-user-pages');
    Route::get('/account/reservations', 'index')->middleware('can:access-user-pages');
    Route::delete('/reservations/{reservation}', 'destroy')->middleware('can:access-user-pages');
});

Route::controller(StaffReservationController::class)->group(function(){
    Route::get('/branches/{branch}/reservations', 'index')->middleware('can:access-staff-and-admin-pages');
    Route::post('/reservations/{reservation}', 'fulfil')->middleware('can:access-staff-and-admin-pages');
});

Route::controller(BranchController::class)->group(function(){
    // TODO: Add gate to restrict access to staff in branch
    Route::get('/branches', 'index')->middleware('can:access-staff-and-admin-pages');
    Route::get('/branches/create', 'create')->middleware('can:access-admin-pages');
    Route::post('/branches', 'store')->middleware('can:access-admin-pages');
    Route::delete('/branches/{branch}', 'destroy')->middleware('can:access-admin-pages');
    Route::get('/branches/{branch}',  'show')->middleware('can:access-staff-and-admin-pages');
    Route::get('/branches/{branch}/edit', 'edit')->middleware('can:access-admin-pages');
    Route::patch('/branches/{branch}', 'update')->middleware('can:access-admin-pages');
});

Route::controller(InventoryController::class)->group(function(){
    Route::get('/branches/{branch}/inventory', 'index')->middleware('can:access-staff-and-admin-pages');
    Route::get('/branches/{branch}/inventory/create', 'create')->middleware('can:access-staff-and-admin-pages');
    Route::patch('/branches/{branch}/inventory/{book}', 'update')->middleware('can:access-staff-and-admin-pages');
    Route::post('/branches/{branch}/inventory', 'store')->middleware('can:access-staff-and-admin-pages');
    Route::get('/branches/{branch}/inventory/{book}', 'edit')->middleware('can:access-staff-and-admin-pages');
    Route::delete('/branches/{branch}/inventory/{book}', 'destroy')->middleware('can:access-staff-and-admin-pages');
    Route::post('/branches/{branch}/inventory/{book}/transfer', 'transfer')->middleware('can:access-staff-and-admin-pages');
});

Route::controller(StaffSalesController::class)->group(function(){
    Route::get('/branches/{branch}/sales', 'index')->middleware('can:access-staff-and-admin-pages');
    Route::get('/branches/{branch}/sales/create', 'create')->middleware('can:access-staff-and-admin-pages');
    Route::get('/branches/{branch}/sales/{sale}', 'show')->middleware('can:access-staff-and-admin-pages');
});

Route::get('/invoices/{sale}', [SaleController::class, 'generateInvoice']); # TODO: Add middleware

Route::controller(PurchaseController::class)->group(function(){
    Route::get('/branches/{branch}/purchases', 'index')->middleware('can:access-staff-and-admin-pages');
    Route::get('/branches/{branch}/purchases/create', 'create')->middleware('can:access-staff-and-admin-pages');
    Route::post('/branches/{branch}/purchases', 'store')->middleware('can:access-staff-and-admin-pages');
});
