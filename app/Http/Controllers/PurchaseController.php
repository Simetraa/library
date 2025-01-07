<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Purchase;
use App\Models\Sale;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Str;

class PurchaseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, Branch $branch)
    {
        $purchaseId = $request->get("purchase-id");
        $bookId = $request->get("book-id") ;
        $supplier = $request->get("supplier");
        $sortBy = $request->get("sort-by");

        $purchases = $branch->purchases; // Start with the branch ID

        if (!empty($purchaseId)) {
            $purchases = $purchases->where('id', $purchaseId);
        }

        if (!empty($bookId)) {
            $purchases = $purchases->where('book_id', $bookId);
        }

        if (!empty($supplier)) {
            $purchases = $purchases->filter(function ($purchase) use ($supplier) {
                return Str::contains(strtolower($purchase->supplier), strtolower($supplier)); // Case-insensitive LIKE
            });
        }


        $purchases = Purchase::whereIn('id', $purchases->pluck('id'))->paginate(15);

        return view('branches.purchases.index', ['branch' => $branch,
            'purchases' => $purchases,
            'purchase-id' => $purchaseId,
            'book-id' => $bookId,
            'supplier' => $supplier,
            ]);
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

        // check if the book is in the pivot table, if not attach it

        if(!$branch->books->contains(request("book_id"))){
            $branch->books()->attach(request("book_id"), ['quantity' => request("quantity")]);
        } else {
            $branch->books->find(
                request("book_id"))
                ->pivot->update(
                    ['quantity' =>
                        request("quantity") + $branch->books
                            ->find(request("book_id"))->pivot->quantity]);
        }



        return redirect("branches/{$branch->id}/purchases");
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
