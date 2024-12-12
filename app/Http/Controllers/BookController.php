<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use function Laravel\Prompts\search;

class BookController extends Controller
{
    public function catalogue(Request $request){

        $genresFiltered = $request->get("genre") ?? [];
        $genreNames = [];

        $subjectList = app(CategoryController::class)->getCategories();

        foreach ($genresFiltered as $genre){
            [$subjectIdx, $categoryIdx] = explode(",", $genre);

            $subjectIdx -= 1; // subtract 1 to account for loop() offset
            if($categoryIdx == 1) {
                $genreName = array_keys($subjectList)[$subjectIdx];
            } else {
                $key = $subjectList[array_keys($subjectList)[$subjectIdx]];

                $categoryIdx -= 2; // subtract 2 to account for header & loop() offset
                $genreName = $key[$categoryIdx];
            }
            $genreNames[] = $genreName;
        }

        $books = collect();





        foreach($genreNames as $genreName) {
            $books = $books->union(DB::table('books')->where('subjects', 'like', '%"'.$genreName.'"%')->get());
        }

        if($genresFiltered == []) { // if no filters are checked, include all books
            $books = Book::all();
        }

        $search = $request->get('search');

        $authorSearch = $books->filter(function ($item) use ($search) {
            return false !== stripos($item->author, $search);
        });

        $titleSearch = $books->filter(function ($item) use ($search) {
            return false !== stripos($item->title, $search);
        });

        // TODO: We have duplication when filtering for Design

        $books = $authorSearch->merge($titleSearch);

        $sortBy = $request->get("sort-by");

        $books = $books->unique(); // MAKE SURE THIS WORKS.

        switch($sortBy) {
            case "relevance":
                break; // TODO: Implement relevance based on popularity
            case "price-low-high":
                $books = $books->sortBy("price");
                break;
            case "price-high-low":
                $books = $books->sortByDesc("price");
                break;
            case "title-az":
                $books = $books->sortBy("title");
                break;
            case "title-za":
                $books = $books->sortByDesc("title");
                break;
            case "author-az":
                $books = $books->sortBy("author");
                break;
            case "author-za":
                $books = $books->sortByDesc("author");
                break;
            case "date-latest":
                $books = $books->sortByDesc("publication_date");
                break;
            case "date-oldest":
                $books = $books->sortBy("publication_date");
        }


        $books = Book::hydrate($books->toArray());


        return view('catalogue', [
            "books" => $books,
            "subjects" => app(CategoryController::class)->getCategories(),
            "filters" => $genresFiltered,
            "sort-by" => $sortBy,
            "search" => $search,
            "genreNames" => $genreNames
        ]);
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
            'subject' =>[],
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

        return redirect("/inventory");
    }
    public function update(Book $book, Request $request)
    {
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
