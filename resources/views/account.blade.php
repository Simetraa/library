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
    <div class="account-container">
        <h1 style="margin-left: 15px">Account</h1>
        <hr>
        <div class="account-info">
                <form method="POST" action="/account" class="profile-container">
                    <h2>Profile</h2>
                    @csrf
                    @method('PATCH')
                    <div class="">
                        <div class = "space-between">
                            <label for="email">Email: </label>
                            <input type="email" name="email" value="{{ Auth::user()->email }}">
                        </div>

                        @error('email')
                        {{ $message }}
                        @enderror

                    </div>
                    @php
                        $currentBranch = Auth::user()->branch->id;
                        $branches = Branch::getBranches();
                    @endphp

                    <div class = "space-between">
                        <label for="branch">Branch: </label>
                        <x-dropdown name="branch_id" :options="$branches" :value="$currentBranch"></x-dropdown>
                    </div>

                    @error('branch_id')
                    {{ $message }}
                    @enderror

                    <button class="profile-button" type="submit">Save changes</button>
                </form>

            <hr>
                <form method="POST" action="/account/password" class="update-password-conatiner">
                    <h2>Update password</h2>
                    @csrf
                    @method('PUT')
                    <div class = "space-between">
                        <label for="current_password">Current password:</label>
                        <input type="password" name="current_password">
                    </div>
                    <div class = "space-between">
                        <label for="password">New password: </label>
                        <input type="password" name="password">
                    </div>
                    <div class = "space-between">
                        <label for="password">Confirm password: </label>
                        <input type="password" name="password_confirmation">
                    </div>

                    @error('password')
                    {{ $message }}
                    @enderror

                    <button class="profile-button">Change password</button>
                </form>
        </div>



        <hr>
        <div class="delete-button-container">
            <form method="POST" action="{{ route('account.destroy') }}">
                @csrf
                @method('DELETE')
                <button name="delete" class="delete-profile-button">Delete account</button>
            </form>

        </div>
    </div>




</div>
</body>
