<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Branch;
use Illuminate\Http\Request;

class InventoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Branch $branch)
    {
        return view('branches.inventory.index', ['branch' => $branch]);
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Book $book)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Book $book)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Book $book)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Branch $branch, Book $book)
    {
        // TODO: Display a confirmation before deleting a book if quantity > 0
        // and do it anyway just do it doubly so if there are still books there.

        $branch->books->find($book)->pivot->delete();
        return back();
    }
}
