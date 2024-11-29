<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function catalogue(){
        return view('catalogue', ["books" => Book::all()]);
    }
    public function inventory(){
        return view('inventory', ["books" => Book::all()]);
    }
    public function store(){
        request()->validate([
        'title' => ['required', 'min:3'],
        'author' => ['required'],
        'cover_url' => ['required'],
        'description' => ['required'],
        'price' => ['required', 'numeric'],
        'quantity' => ['required', 'numeric']
        ]);

        Book::create([
            'title' => request("title"),
            'author' => request("author"),
            'cover_url' => request("cover_url"),
            'description' => request("description"),
            'price' => request("price"),
            'quantity' => request("quantity")
        ]);
        return redirect("/inventory");
    }
    public function create(){
        return view("books.create");
    }
    public function show(Book $book){
        return view("books.show", ["book" => $book]);
    }
    public function edit(Book $book){
        return view("books.edit", ["book" => $book]);
    }
    public function destroy(Book $book){
        $book->delete();

        return redirect("/books");
    }
    public function update(Book $book, Request $request){
        $book->update([
            'title' => request('title'),
            'author' => request('author'),
            'cover_url' => request('cover_url'),
            'description' => request('description'),
            'price' => request('price'),
            'quantity' => request('quantity')
        ]);
        return redirect('/inventory');
    }
}
