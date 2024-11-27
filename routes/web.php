/<?php

use App\Http\Controllers\BookController;
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

//Route::get('/', function () {        //make page
////    dd(Book::find(1));
//    return view('catalogue', ["books" => Book::all()]);
//});
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

//Route::get('/inventory', function () {
//    return view('inventory', ["books" => Book::all()]);
//});

//Route::get('/books/create', function () {
//
//    return view("books.create");
//});

        //books
//Route::get('/books/{book}', function (Book $book) {
//    return view("books.show", ["book" => $book]);
//});

//Route::get('/books/{book}/edit', function (Book $book) {
//    return view("books.edit", ["book" => $book]);
//});

//Route::delete('/books/{book}', function (Book $book) {
//    $book->delete();
//
//    return redirect("/books");
//}
//);

//Route::patch('/books/{book}', function (Book $book) {
//    request()->validate([
//        'title' => ['required', 'min:3'],
//        'author' => ['required'],
//        'cover' => ['image'],
//        'description' => ['required'],
//        'price' => ['required', 'numeric'],
//        'quantity' => ['required', 'numeric']
//    ]);

    // authorize (On hold...)


//    $book->update([
//        'title' => request('title'),
//        'author' => request('author'),
//        'cover_url' => request('cover_url'),
//        'description' => request('description'),
//        'price' => request('price'),
//        'quantity' => request('quantity')
//    ]);

//    return redirect('/books/' . $book->id);
//});



