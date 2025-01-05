<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class StaffController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Branch $branch)
    {
        return view('branches.staff.index', [
            'branch' => $branch,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Branch $branch)
    {
        return view('branches.staff.create', [
            'branch' => $branch,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Branch $branch)
    {
        $request->mergeIfMissing(['branch_id' => $branch->id]);
        $validatedAttributes = $request->validate(
            [
                "email" => ["required", "email", "max:255", "unique:users"],
                "password" => ["required", Password::min(5), "confirmed"],
                "branch_id" => ["exists:App\Models\Branch,id"],
            ]
        );

        $validatedAttributes['role'] = 'staff';

        $user = User::create($validatedAttributes);
        Auth::login($user);

        return redirect("/");
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Branch $branch, User $user)
    {
        return view('branches.staff.edit', [
            'branch' => $branch,
            'user' => $user,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Branch $branch, User $user)
    {
            $validatedAttributes = $request->validate(
            [
                "email" =>
                    ["required", "email", "max:255", Rule::unique('users')->ignore($user)],
                "branch_id" =>
                    ["exists:App\Models\Branch,id"]
            ]
            );

        $user->update($validatedAttributes);

        // TODO: Maybe? adjust where we send users
        return redirect("/branches/{$user->branch->id}/staff");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Branch $branch, User $user)
    {
        $user->delete();
        return back();
    }
}
