<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Branch;
use App\Models\Sale;
use Illuminate\Http\Request;

class BranchController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index() {
        return view('branches.index');
    }
    public function show(Request $request, Branch $branch)
    {
        $topSellingItemsPeriod = $request->get("topSellingItemsPeriod") ?? "";

        $topSellingItems = Book::all()->sortByDesc(
            function (Book $book) use ($topSellingItemsPeriod) {
                return $book->getSalesQuantity($topSellingItemsPeriod);
            })->take(5);

        $pendingReservations = $branch->reservations()->where("status", "pending")->count();
        $collectedReservations = $branch->reservations()->where("status", "collected")->count();

        $booksOutOfStockCount = $branch->books->filter(function ($book) {
            return $book->pivot->quantity === 0;
        })->count();

        $booksInStockCount = $branch->books->filter(function ($book) {
            return $book->pivot->quantity > 0;
        })->count();

        $totalRevenue = $branch->sales->sum(function (Sale $sale) {
            return $sale->totalPrice();
        });

        $quantitySold = $branch->sales->sum(function (Sale $sale) {
            return $sale->books->sum("quantity");
        });


        return view('branches.show',
            [
                "branch" => $branch,
                "topSellingItems" => $topSellingItems,
                "topSellingItemsPeriod" => $topSellingItemsPeriod,
                "pendingReservations" => $pendingReservations,
                "collectedReservations" => $collectedReservations,
                "booksOutOfStockCount" => $booksOutOfStockCount,
                "booksInStockCount" => $booksInStockCount,
                "totalRevenue" => $totalRevenue,
                "quantitySold" => $quantitySold,
            ]);
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
