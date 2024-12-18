<!DOCTYPE html>
<html lang="en">
@php
    use App\Models\Branch;
@endphp

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catalogue</title>
    <link rel="stylesheet" href="{{ asset('styles.css') }}?ts=<?=time()?>"/>
    <link rel="stylesheet" href="{{ asset('mobile.css') }}?ts=<?=time()?>" media ="only screen and (max-width: 720px)"/>
</head>

<body class="non-gradient-body">
<x-header></x-header>
{{--  input fields for email, password, branch, reservations, purchases, delete account  --}}

<div>
    <h1>Account</h1>
    <form method="POST" action="/account">
        <h2>Profile</h2>
        @csrf
        @method('PATCH')
        <div class="">
            <label for="email">Email: </label>
            <input type="email" name="email" value="{{ request()->user()->email }}">
            @error('email')
            {{ $message }}
            @enderror

        </div>
        @php
            $currentBranch = request()->user()->branch->id;
            $branches = Branch::getBranches();
       @endphp

        <label for="branch">Branch: </label>
        <x-dropdown name="branch_id" :options="$branches" :value="$currentBranch"></x-dropdown><br>
        @error('branch_id')
        {{ $message }}
        @enderror

        <button type="submit">Save changes</button>
    </form>

    <form method="POST" action="/account/password">
        <h2>Update password</h2>
        @csrf
        @method('PUT')
            <label for="current_password">Current password</label>
            <input type="password" name="current_password"><br>
            <label for="password">Password: </label>
            <input type="password" name="password"><br>
            <label for="password">Confirm password: </label>
            <input type="password" name="password_confirmation"><br>
            @error('password')
            {{ $message }}
            @enderror

            <button>Change password</button>
    </form>


    <form method="POST" action="{{ route('account.destroy') }}">
        <h2>Delete account</h2>
        @csrf
        @method('DELETE')
            <button name="delete">Delete account</button>
    </form>



</div>
</body>
