<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class RegisteredUserController extends Controller
{
    public function show() {
        return view('user.account');
    }
    public function create() {
        return view('auth.register');
    }

    public function update(Request $request)
    {
        $validatedAttributes = $request->validate(
            [
                "email" =>
                    ["required", "email", "max:255", Rule::unique('users')->ignore(Auth::user())],
                "branch_id" =>
                    ["exists:App\Models\Branch,id"]
            ]);

        // TODO: Take a look at why this is necessary
//        dd($validatedAttributes);
        $request->user()->update($validatedAttributes);
        return back();
    }

    public function store(){
        $validatedAttributes = request()->validate(
            ["email" => ["required", "email", "max:255", "unique:users"],
            "password" => ["required", Password::min(5), "confirmed"],
            "branch_id" => ["exists:App\Models\Branch,id"]
            ]
        );

        $user = User::create($validatedAttributes);
//        dd($user);
        Auth::login($user);

        return redirect("/");
    }
    public function destroy(){
        Auth::user()->delete();

        return redirect("/");
    }

}
