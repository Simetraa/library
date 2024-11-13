<?php

use Illuminate\Support\Facades\Route;
use App\Models\Book;

Route::get('/welcome', function () {
    return view('welcome');
});
Route::get('/', function () {        //make page
//    dd(Book::find(1));
    return view('catalogue', ["books" => Book::all()]);
});
Route::get('/login', function () {
    return view('login');
});
Route::get('/register', function () {       //change later
    return view('register');
});
Route::get('/dashboard', function () {
    return view('dashboard');
});
Route::get('/account', function () {        //make page
    return view('account');
});
Route::get('/book/{id}', function (string $id) {
    return view("book", ["book" => Book::find($id)]);
});
