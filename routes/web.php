<?php

use Illuminate\Support\Facades\Route;

Route::get('/welcome', function () {
    return view('welcome');
});
Route::get('/', function () {        //make page
    return view('catalogue');
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
Route::get('/book', function () {        //make page
    return view('book');
});
