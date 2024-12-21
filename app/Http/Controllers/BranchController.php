<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use Illuminate\Http\Request;

class BranchController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('branches.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('branches.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required']
        ]);

        Branch::create([
            'name' => request("name")
        ]);
        return redirect("/branches");
    }

    /**
     * Display the specified resource.
     */
    public function show(Branch $branch)
    {
        return view("branches.show", ["branch" => $branch]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Branch $branch)
    {
        return view("branches.edit", ["branch" => $branch]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Branch $branch)
    {
        $branch->update([
            'name' => $request->get('name')
        ]);
        return redirect('/branches');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Branch $branch)
    {
        $branch->delete();

        // TODO: We have to ensure there are no books in the branch before deleting it.

        return redirect("/branches");
    }

}
