<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Purchase;
use App\Models\Sale;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

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
    public function store(Request $request, Branch $branch)
    {
        request()->validate([
            'book_id' => ['required', 'exists:books,id'],
            'quantity' => ['required'],
            'price' => ['required'],
            'supplier' => ['required'],
        ]);

        Purchase::create([
            'branch_id' => $branch->id,
            'book_id' => request("book_id"),
            'quantity' => request("quantity"),
            'price' => request("price"),
            'supplier' => request("supplier"),
        ]);
        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Branch $branch, Purchase $purchase)
    {
        return view("branches.purchase.show", ["purchase" => $purchase]);
    }

    public function generateInvoice(Purchase $purchase): Response
    {
        $pdf = PDF::loadView("pdf.purchase-invoice", ["purchase" => $purchase]); // Load a view for the PDF

        //return $pdf->download('document.pdf');
        return $pdf->stream('invoice.pdf');
    }
}
