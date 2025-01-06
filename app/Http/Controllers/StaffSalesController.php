<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Purchase;
use App\Models\Sale;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class StaffSalesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, Branch $branch)
    {
        $saleId = $request->get("sale-id");
        $userId = $request->get("user-id") ;
        $email = $request->get("email");
        $sortBy = $request->get("sort-by");


        $sales = $branch->sales; // Start with the branch ID

        if (!empty($saleId)) {
            $sales = $sales->where('id', $saleId);
        }

        if (!empty($userId)) {
            $sales = $sales->where('user_id', $userId);
        }

        if (!empty($email)) {
            $sales = $sales->where('email', $email);
        }


        switch ($sortBy) {
            case 'quantity-low-high':
                $sales = $sales->sortBy('quantity');
                break;
            case 'quantity-high-low':
                $sales = $sales->sortByDesc('quantity');
                break;
            case 'price-low-high':
                $sales = $sales->sortBy('price');
                break;
            case 'price-high-low':
                $sales = $sales->sortByDesc('price');
                break;
            case 'time-old-new':
                $sales = $sales->sortBy('created_at');
                break;
            case 'time-new-old':
                $sales = $sales->sortByDesc('created_at');
                break;
        }

        $sales = Sale::whereIn('id', $sales->pluck('id'))->paginate(15);

        return view('branches.sales.index', ['branch' => $branch,
            'sales' => $sales,
            'sale-id' => $saleId,
            'user-id' => $userId,
            'email' => $email,
            'sort-by' => $sortBy
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Branch $branch)
    {
        return view("branches.sales.create", ['branch' => $branch]);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        request()->validate([
            'branch_id' => ['required'],
            'books' => ['required']
        ]);

        Sale::create([
            'branch_id' => request("branch_id"),
            'books' => request("books")
        ]);
//        return redirect("");
    }

    /**
     * Display the specified resource.
     */
    public function show(Branch $branch, Sale $sale)
    {
        return view("branches.sales.show", ["sale" => $sale]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Sale $sale)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Sale $sale)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Sale $sale)
    {
        //
    }
}
