<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }



    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoryRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryRequest $request, Category $category)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        //
    }

    public function getCategories() {
        $categories = [
            "Arts" => [
                "Architecture",
                "Art Instruction",
                "Art History",
                "Dance",
                "Design",
                "Fashion",
                "Film",
                "Graphic Design",
                "Music",
                "Music Theory",
                "Painting",
                "Photography",
            ],
            "Animals" => [
                "Bears",
                "Cats",
                "Kittens",
                "Dogs",
                "Puppies",
            ],
            "Fiction" => [
                "Fantasy",
                "Historical Fiction",
                "Horror",
                "Humor",
                "Literature",
                "Magic",
                "Mystery and detective stories",
                "Plays",
                "Poetry",
                "Romance",
                "Science Fiction",
                "Short Stories",
                "Thriller",
                "Young Adult",
            ],
            "Science & Mathmatics" => [
                "Biology",
                "Chemistry",
                "Mathematics",
                "Physics",
                "Programming",
            ],
            "Business & Finance" => [
                "Management",
                "Entrepreneurship",
                "Business Economics",
                "Business Success",
                "Finance",
            ],
            "Children's" => [
                "Kids Books",
                "Stories in Rhyme",
                "Baby Books",
                "Bedtime Books",
                "Picture Books",
            ],
            "History" => [
                "Ancient Civilization",
                "Archaeology",
                "Anthropology",
                "World War II",
                "Social Life and Customs",
            ],
            "Health & Wellness" => [
                "Cooking",
                "Cookbooks",
                "Mental Health",
                "Exercise",
                "Nutrition",
                "Self-help",
            ],
            "Biography" => [
                "Autobiographies",
                "History",
                "Politics and Government",
                "World War II",
                "Women",
                "Kings and Rulers",
                "Composers",
                "Artists",
            ],
            "Social Sciences" => [
                "Anthropology",
                "Religion",
                "Political Science",
                "Psychology",
            ],
            "Textbooks" => [
                "History",
                "Mathematics",
                "Geography",
                "Psychology",
                "Algebra",
                "Education",
                "Business & Economics",
                "Science",
                "Chemistry",
                "English Language",
                "Physics",
                "Computer Science"
            ],
        ];
        return $categories;
    }
}
