<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class StaffPasswordController extends Controller
{
    /**
     * Update the user's password.
     */
    public function update(Request $request, Branch $branch, User $user): RedirectResponse
    {
        $validatedAttributes = $request->validate([
            'current_password' => ['required', 'current_password'],
            'password' => ['required', Password::min(12), 'confirmed'],
        ]);

        $user->update([
            'password' => Hash::make($validatedAttributes['password']),
        ]);

        return back();
    }
}
