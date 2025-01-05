<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Sale;
use Illuminate\Http\Request;

class StaffSalesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Branch $branch)
    {
        return view("branches.sales.index", ['branch' => $branch]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Branch $branch)
    {
        return view("branches.sales.create", ['branch' => $branch]);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        request()->validate([
            'branch_id' => ['required'],
            'books' => ['required']
        ]);

        Sale::create([
            'branch_id' => request("branch_id"),
            'books' => request("books")
        ]);
//        return redirect("");
    }

    /**
     * Display the specified resource.
     */
    public function show(Branch $branch, Sale $sale)
    {
        return view("branches.sales.show", ["sale" => $sale]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Sale $sale)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Sale $sale)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Sale $sale)
    {
        //
    }
}
