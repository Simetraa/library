<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use function Pest\Laravel\json;

class ReservationController extends Controller
{
    public function store(){
        request()->validate([
            'branch_id' => ['required', 'numeric'],
            'book_id' => ['required', 'numeric'],
            'quantity' => ['required', 'numeric']
        ]);


        $reservation = Reservation::create([
            'user_id' => Auth::id(),
            'branch_id' => request("branch_id"),
            'book_id' => request("book_id"),
            'quantity' => request("quantity"),
            'status' => "pending",      // TODO implement reservation system
        ]);

        return redirect("/");
    }

    public function index(){
        $reservations = Reservation::all();
        return $reservations;
    }
}
