<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;

class RegisteredUserController extends Controller
{
    public function create() {
        return view('auth.register');
    }
    public function store(){
        $validatedAttributes = request()->validate(
            ["email" => ["required", "email", "max:255", "unique:users"],
            "password" => ["required", Password::min(5), "confirmed"]]
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
