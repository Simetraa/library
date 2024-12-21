<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Branch;
use App\Models\Reservation;
use App\Models\Sale;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request, Branch $branch)
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


        return view('branches.dashboard',
            [
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
}
