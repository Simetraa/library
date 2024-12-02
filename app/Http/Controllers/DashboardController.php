<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $topSellingItems = Book::all()->take(5);
        $topSellingItemsPeriod = $request->get("topSellingItemsPeriod");

        return view('dashboard', ["topSellingItems" => $topSellingItems, "topSellingItemsPeriod" => $topSellingItemsPeriod]);
    }


}
