<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Reservation;
use App\Models\Sale;
use Illuminate\Http\Request;

class StaffReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, Branch $branch)
    {
        $reservationId = $request->get("reservation-id");
        $userId = $request->get("user-id");
        $email = $request->get("email");
        $sortBy = $request->get("sort-by");
        $collected = $request->get("collected");

        $reservations = $branch->reservations; // Start with the branch ID

        if (!empty($reservationId)) {
            $reservations = $reservations->where('id', $reservationId);
        }

        if (!empty($userId)) {
            $reservations = $reservations->where('user_id', $userId);
        }

        if (!empty($email)) {
            $reservations = $reservations->where('email', $email);
        }

        if (!empty($collected)) {
            $reservations = $reservations->where('status', $collected);
        }

        switch ($sortBy) {
            case 'time-old-new':
                $reservations = $reservations->sortBy('created_at');
                break;
            case 'time-new-old':
                $reservations = $reservations->sortByDesc('created_at');
                break;
        }

        $reservations = Reservation::whereIn('id', $reservations->pluck('id'))->paginate(15);

        return view('branches.reservations.index', ['branch' => $branch,
            'reservations' => $reservations,
            'reservation-id' => $reservationId,
            'user-id' => $userId,
            'email' => $email,
            'sort-by' => $sortBy
        ]);

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
