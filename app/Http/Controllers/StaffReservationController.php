<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Reservation;
use Illuminate\Http\Request;

class StaffReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Branch $branch)
    {
        return view('branches.reservations.index', ['branch' => $branch]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

//    /**
//     * Store a newly created resource in storage.
//     */
//    public function store(Request $request)
//    {
//        //
//    }

    public function fulfil(Reservation $reservation)
    {
        $branch = $reservation->branch;

//        dd($branch->books->first()->pivot->quantity);
        $branchBookPivot = $branch->books->where('id', $reservation->book->id)->first()->pivot;
//        dd($branchBookPivot);
        $branchStock = $branchBookPivot->quantity;
        $reservationQuantity = $reservation->quantity;

        $isStockAvailable = $branchStock >= $reservationQuantity;

        if(!$isStockAvailable){
            abort(409);
        }

        $isFulfilled = $reservation->status === "collected";

        if($isFulfilled){
            abort(409);
        }


        $branchBookPivot->quantity = $branchStock - $reservationQuantity;
        $branchBookPivot->save();

        $reservation->status = "collected";
        $reservation->save();

        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Branch $branch)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Branch $branch)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Branch $branch)
    {

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Branch $branch)
    {
        //
    }
}
