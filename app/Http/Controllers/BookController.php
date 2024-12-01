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

    private function categorise($terms) {
        // search


        foreach ($terms as $seeking) {
            foreach (self::categories as $category) {
                [$subject, $category] = explode("/", $category);
                if($seeking == $category){

                }
            }
        }



    }
    const categories = [
        "Arts/Arts",
        "Arts/Architecture",
        "Arts/Art Instruction",
        "Arts/Art History",
        "Arts/Dance",
        "Arts/Design",
        "Arts/Fashion",
        "Arts/Film",
        "Arts/Graphic Design",
        "Arts/Music",
        "Arts/Music Theory",
        "Arts/Painting",
        "Arts/Photography",
        "Animals/Animals",
        "Animals/Bears",
        "Animals/Cats",
        "Animals/Kittens",
        "Animals/Dogs",
        "Animals/Puppies",
        "Fiction/Fiction",
        "Fiction/Fantasy",
        "Fiction/Historical Fiction",
        "Fiction/Horror",
        "Fiction/Humor",
        "Fiction/Literature",
        "Fiction/Magic",
        "Fiction/Mystery and detective stories",
        "Fiction/Plays",
        "Fiction/Poetry",
        "Fiction/Romance",
        "Fiction/Science Fiction",
        "Fiction/Short Stories",
        "Fiction/Thriller",
        "Fiction/Young Adult",
        "Science & Mathematics/Science & Mathematics",
        "Science & Mathematics/Biology",
        "Science & Mathematics/Chemistry",
        "Science & Mathematics/Mathematics",
        "Science & Mathematics/Physics",
        "Science & Mathematics/Programming",
        "Business & Finance/Business & Finance",
        "Business & Finance/Management",
        "Business & Finance/Entrepreneurship",
        "Business & Finance/Business Economics",
        "Business & Finance/Business Success",
        "Business & Finance/Finance",
        "Children's/Children's",
        "Children's/Kids Books",
        "Children's/Stories in Rhyme",
        "Children's/Baby Books",
        "Children's/Bedtime Books",
        "Children's/Picture Books",
        "History/History",
        "History/Ancient Civilization",
        "History/Archaeology",
        "History/Anthropology",
        "History/World War II",
        "History/Social Life and Customs",
        "Health & Wellness/Health & Wellness",
        "Health & Wellness/Cooking",
        "Health & Wellness/Cookbooks",
        "Health & Wellness/Mental Health",
        "Health & Wellness/Exercise",
        "Health & Wellness/Nutrition",
        "Health & Wellness/Self-help",
        "Biography/Biography",
        "Biography/Autobiographies",
        "Biography/History",
        "Biography/Politics and Government",
        "Biography/World War II",
        "Biography/Women",
        "Biography/Kings and Rulers",
        "Biography/Composers",
        "Biography/Artists",
        "Social Sciences/Social Sciences",
        "Social Sciences/Anthropology",
        "Social Sciences/Religion",
        "Social Sciences/Political Science",
        "Social Sciences/Psychology",
        "Textbooks/Textbooks",
        "Textbooks/History",
        "Textbooks/Mathematics",
        "Textbooks/Geography",
        "Textbooks/Psychology",
        "Textbooks/Algebra",
        "Textbooks/Education",
        "Textbooks/Business & Economics",
        "Textbooks/Science",
        "Textbooks/Chemistry",
        "Textbooks/English Language",
        "Textbooks/Physics",
        "Textbooks/Computer Science"
    ];
}
