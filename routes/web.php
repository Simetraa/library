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

Route::get('/inventory', function () {
    return view('inventory', ["books" => Book::all()]);
});

Route::get('/books/create', function () {

    return view("books.create");
});

        //books
Route::get('/books/{id}', function (string $id) {
    return view("books.show", ["book" => Book::find($id)]);
});

Route::get('/books/{id}/edit', function ($id){
    $book = Book::find($id);

    return view("books.edit", ["book" => $book]);
});

Route::patch('/books/{id}', function ($id) {
//    request()->validate([
//        'title' => ['required', 'min:3'],
//        'author' => ['required'],
//        'cover' => ['image'],
//        'description' => ['required'],
//        'price' => ['required', 'numeric'],
//        'quantity' => ['required', 'numeric']
//    ]);

    // authorize (On hold...)

    $book = Book::findOrFail($id);

    $book->update([
        'title' => request('title'),
        'author' => request('author'),
        'cover_url' => request('cover_url'),
        'description' => request('description'),
        'price' => request('price'),
        'quantity' => request('quantity')
    ]);

    return redirect('/books/' . $book->id);
});



