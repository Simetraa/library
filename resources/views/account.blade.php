<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catalogue</title>
    <link rel="stylesheet" href="{{ asset('styles.css') }}?ts=<?=time()?>"/>
    <link rel="stylesheet" href="{{ asset('mobile.css') }}?ts=<?=time()?>" media ="only screen and (max-width: 720px)"/>
    <script src="{{ asset('preserve_scroll.js') }}"></script>
    <script src="{{ asset('filters.js')}}" defer></script>
</head>

<body class="non-gradient-body">
<x-header></x-header>
{{--  input fields for email, password, branch, reservations, purchases, delete account  --}}

<div>
    <h1>Account</h1>
    <form method="POST" action="/account">
        @csrf
        <div class="">
            <label for="email">Email</label>
            <input type="email" name="email" value="{{ Auth::user()->email }}">
        </div>
        <div class="">
            <label for="password">Password</label>
            <input type="password" name="password">
        </div>

        @php
            use App\Models\Branch;
            $currentBranch = Branch::first()->id;
            $branches = Branch::getBranches();
       @endphp

        <div class="">
            <label for="branch_id">Branch</label>
            <x-dropdown name="branch_id" :options="$branches" :value="$currentBranch"></x-dropdown>
        </div>

        <button type="submit" class = "edit-create-button">Submit</button>
    </form>

    <form method="POST" action="{{ route('account.destroy') }}">
        @csrf
        @method('DELETE')
        <div class="">
            <button name="delete">Delete account</button>
        </div>
    </form>


</div>

</body>
