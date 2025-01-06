<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use function Laravel\Prompts\search;

class BookController extends Controller
{
    public function autofill(Request $request) {


        set_time_limit(120); // this can take a while as we have to submit multiple requests

        $isbn = $request->get("isbn");
        $isbn = str_replace("-", "", $isbn);

        $editionUrl = "https://openlibrary.org/isbn/" . $isbn . ".json";
        $editionResponse = @file_get_contents($editionUrl);
        if($editionResponse === false) {
            return back()->withErrors(["autofill" => "Book not found"]);
        }
        $editionJson = json_decode($editionResponse);

        $title = $editionJson->title;
        $publicationDate = Carbon::createFromDate($editionJson->publish_date, 1, 1)->format("Y-m-d");


//        dd($publicationDate, $editionJson);

        $authorIdList = $editionJson->authors;
        $authors = collect($authorIdList);
        $authors = $authors ->map(function($authorId) {
            $authorId = str_replace("/authors/", "", $authorId->key);
            $authorUrl = 'https://openlibrary.org/authors/' . $authorId . '.json';
            $authorResponse = @file_get_contents($authorUrl);
            if($authorResponse === false) {
                return back()->withErrors(["autofill" => "Author not found"]);
            }
            $authorJson = json_decode($authorResponse);
            return $authorJson->name;
        });

        $authors = join(",", $authors->toArray());


        $cover_url = "https://covers.openlibrary.org/b/id/" . $editionJson->covers[0] . "-L.jpg";

        $workId = str_replace("/works/", "", $editionJson->works[0]->key);
        $workUrl = 'https://openlibrary.org/works/' . $workId . '.json';
        $workResponse = @file_get_contents($workUrl);
        if($workResponse === false) {
            return back()->withErrors(["autofill" => "Work not found"]);
        }
        $workJson = json_decode($workResponse);

        $description = $workJson->description;
        $subjects = join(",", $workJson->subjects);


        return back()->with(
            [
                "isbn" => $isbn,
                "title" => $title,
                "author" => $authors,
                "cover_url" => $cover_url,
                "description" => $description,
                "subjects" => $subjects,
                "publication_date" => $publicationDate
            ]
        );
    }

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

        $books = $books->where('visible', true);

        $books = Book::whereIn('id', $books->pluck('id'))->paginate(42);

        return view('catalogue', [
            "books" => $books,
            "subjects" => app(CategoryController::class)->getCategories(),
            "filters" => $genresFiltered,
            "sort-by" => $sortBy,
            "search" => $search,
            "genreNames" => $genreNames
        ]);
    }
    public function index(){
        return view('books.index', ["books" => Book::all()]);
    }
    public function store(Request $request){

        // TODO: Work out what is required, and clean up using Request.
        $validatedAttributes = $request->validate([
            'title' => ['required'],
            'author' => ['required'],
            'cover_url' => ['required'],
            'description' => ['required'],
            'price' => ['required', 'numeric'],
            'isbn' => ['required', 'numeric'],
            'publication_date' => ['required', 'date'],
        ]);


        $subjects = explode(",", request('subjects'));


        $book = Book::create([
            'title' => request("title"),
            'author' => request("author"),
            'cover_url' => request("cover_url"),
            'subjects' => $subjects,
            'description' => request("description"),
            'price' => request("price"),
            'isbn' => request("isbn"),
            'publication_date' => request("publication_date"),
        ]);

        return redirect("/books");
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
    public function toggleVisibility(Book $book){
        $book->update(['visible' => !($book->visible)]);
        return back();
    }

        // TODO

        // Problems I foresee.
        // If a book is deleted, a bunch of pages will start crashing as we try to access
        // book.id. We should implement a soft delete instead, because I think
        // cascading would be worse.
        // this will be very difficult and take a long time of testing and implementation on
        // a bunch of pages.

        // I think it wise to simply remove it from visibility, and NOT remove it from reservations
        // It will still exist in the books/ page and branches/ page
    public function update(Book $book, Request $request)
    {
        $validatedAttributes = $request->validate([
            'title' => ['required'],
            'author' => ['required'],
            'cover_url' => ['required'],
            'description' => ['required'],
            'price' => ['required', 'numeric'],
            'isbn' => ['required', 'numeric'],
            'subjects' => [],
            'publication_date' => ['required', 'date'],
        ]);

        $validatedAttributes['subjects'] = explode(',', $validatedAttributes['subjects']);


        $book->update($validatedAttributes);


        return redirect("/books");
    }
}
