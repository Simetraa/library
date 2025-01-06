<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Purchase;
use Illuminate\Http\Request;

class PurchaseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Branch $branch)
    {
        return view('branches.purchases.index', ['branch' => $branch]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Branch $branch)
    {
        return view("branches.purchases.create", ['branch' => $branch]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        request()->validate([
            'branch_id' => ['required'],
            'book_id' => ['required'],
            'quantity' => ['required'],
            'price' => ['required'],
            'supplier' => ['required'],
        ]);

        Purchase::create([
            'branch_id' => request("branch_id"),
            'books' => request("books"),
            'quantity' => request("quantity"),
            'price' => request("price"),
            'supplier' => request("supplier"),
        ]);
//        return redirect("");
    }

    /**
     * Display the specified resource.
     */
    public function show(Branch $branch, Purchase $purchase)
    {
        return view("branches.purchase.show", ["purchase" => $purchase]);
    }
}
