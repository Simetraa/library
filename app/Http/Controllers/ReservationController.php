<?php

namespace App\Http\Controllers;

use App\Mail\ReservationCancelation;
use App\Mail\ReservationCancellation;
use App\Mail\ReservationConfirmation;
use App\Models\Book;
use App\Models\Branch;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use function Pest\Laravel\json;

class ReservationController extends Controller
{
    public function store(Request $request){
        request()->validate([
            'branch_id' => ['required', 'numeric'],
            'book_id' => ['required', 'numeric'],
            'quantity' => ['required', 'numeric']
        ]);

        $book = Book::find(request('book_id'));

        if(!$book->visible) {
            return back()->withErrors(['This book is not available for reservation']);
        }

        $reservation = Reservation::create([
            'user_id' => Auth::id(),
            'branch_id' => request("branch_id"),
            'book_id' => request("book_id"),
            'quantity' => request("quantity"),
            'status' => "pending",      // TODO implement reservation system
        ]);

        Mail::to($request->user())->send(new ReservationConfirmation($reservation));

        return redirect("/");
    }

    public function index(){
        return view("reservations");
    }

    // delete
    public function destroy(Request $request, Reservation $reservation){
        // check if the user is the owner of the reservation
        if($reservation->user_id !== Auth::id()){
            abort(403);
        }

        $reservation->delete();

        Mail::to($request->user())->send(new ReservationCancellation($reservation));

        return back();
    }
}
