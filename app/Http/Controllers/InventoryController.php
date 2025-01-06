<?php

namespace App\Http\Controllers;

use App\Mail\ReservationCancellation;
use App\Models\Book;
use App\Models\Branch;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rule;

class InventoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Branch $branch)
    {
        $searchQuery = request('search');

//        $books = $branch->books;
//
//        if ($searchQuery) {
//            $books = $books->filter(function ($book) use ($searchQuery) {
//                return strpos(strtolower($book->title), strtolower($searchQuery)) !== false ||
//                    strpos(strtolower($book->author), strtolower($searchQuery)) !== false;
//            });
//        }
//
//        // paginate
//        $books = $books->paginate(10);

        $books = $branch->books()->where('title', 'like', "%$searchQuery%")
            ->orWhere('author', 'like', "%$searchQuery%")
            ->paginate(15);

        return view('branches.inventory.index', ['branch' => $branch, "books" => $books]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Book $book)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Branch $branch, Book $book)
    {
        return view('branches.inventory.edit', ['book' => $book, 'branch' => $branch]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Branch $branch, Book $book)
    {

        $allowedReasons = ['damage', 'lost', 'theft'];

        $validatedAttributes = $request->validate([
            'quantity' => ['required', 'numeric', 'min:0'],
            'reason' => ['required', 'string', Rule::in($allowedReasons)]
        ]);


        $branch->books->find($book)->pivot->update(['quantity' => $validatedAttributes['quantity']]);

        return back();
    }

    public function transfer(Request $request, Branch $branch, Book $book)
    {
        $validatedAttributes = $request->validate([
            'quantity' => ['required', 'numeric', 'min:0'],
            'branch_id' => ['required', 'numeric', 'exists:branches,id']
        ]);

        // $book = $branch->books->find($book);

        $currentBranchQuantity = $branch->books->find($book)->pivot->quantity;

        if($currentBranchQuantity < $validatedAttributes['quantity']) {
            return back()->withError('transfer_quantity');
        }

        $destinationBranch = Branch::find($validatedAttributes['branch_id']);
        if ($destinationBranch->books->find($book)) {
            $destinationBranch->books->find($book)->pivot->quantity += $validatedAttributes['quantity'];
            $destinationBranch->books->find($book)->pivot->save();
        }
        else{
            $destinationBranch->books()->attach($book, ['quantity' => $validatedAttributes['quantity']]);
        }
        $branch->books->find($book)->pivot->quantity -= $validatedAttributes['quantity'];
        $branch->books->find($book)->pivot->save();

//        $destinationBranchBookPivot = $destinationBranch->books->find($book)->firstOrCreate($book);

        // check if destination branch stocks that book?
        // if not, create a new entry in the pivot table?
        // check if source has enough books to transfer
        // if not, return an error message
        // if yes, update the quantity in the pivot table for both branches



//        if ($book->pivot->quantity < $validatedAttributes['quantity']) {
//            return back()->withErrors(['quantity' => 'Not enough books in stock to transfer']);
//        }



//        $branch->books->find($book)->pivot->update(['quantity' => $validatedAttributes['quantity']]);
//        $branch->books->find($book)->pivot->update(['branch_id' => $validatedAttributes['destination_branch_id']]);



        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Branch $branch, Book $book)
    {
        // TODO: Display a confirmation before deleting a book if quantity > 0
        // and do it anyway just do it doubly so if there are still books there.


        // TODO: DO WE HAVE TO USE detatch() instead of delete()?


        foreach($branch->reservations->where('book_id', $book->id)->where('status', 'pending') as $reservation) {
            Mail::to($reservation->user)->send(new ReservationCancellation($reservation));
            $reservation->delete();
        }


        $branch->books->find($book)->pivot->delete();
        return back();
    }
}
