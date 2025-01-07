<!DOCTYPE html>
<html lang="en">
@php
    use App\Models\Branch;
@endphp

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Staff</title>
    <link rel="stylesheet" href="{{ asset('styles.css') }}?ts=<?=time()?>"/>
    <link rel="stylesheet" href="{{ asset('mobile.css') }}?ts=<?=time()?>" media ="only screen and (max-width: 720px)"/>
</head>

<body class="non-gradient-body">
<x-header></x-header>
<div>
    <div class="bg-white-container" id="account-container">
        <h1 style="margin-left: 15px">Account</h1>
        <hr>
        <div class="account-info">
            @php
                $currentBranch = $user->branch->id;
                $branches = Branch::getBranches();
            @endphp


            @can('access-admin-pages')
                <form method="POST" action="/branches/{{$branch->id}}/staff/{{$user->id}}" class="profile-container">
                    <h2>Profile</h2>

                    @csrf
                    @method('PATCH')
                    <div class="">
                        <div class = "space-between">
                            <label for="email">Email: </label>
                            <input type="email" name="email" value="{{ $user->email }}" class="input">
                        </div>

                        @error('email')
                        {{ $message }}
                        @enderror

                    </div>


                    <div class = "space-between">
                        <label for="branch">Branch: </label>
                        <x-dropdown name="branch_id" :options="$branches" :value="$currentBranch"></x-dropdown>
                    </div>

                    @error('branch_id')
                    {{ $message }}
                    @enderror

                    <button class="button-p" id="profile-button" type="submit">Save changes</button>
                </form>
            @endcan
            @can('access-staff-pages')
                    <form class="profile-container">
                        <h2>Profile</h2>

                        @csrf
                        @method('PATCH')
                        <div class="">
                            <div class = "space-between">
                                <label for="email">Email: </label>
                                <input type="email" name="email" value="{{ $user->email }}" class="input" disabled>
                            </div>
                        </div>

                        <div class = "space-between">
                            <label for="branch">Branch: </label>
                            <x-dropdown name="branch_id" :options="$branches" :value="$currentBranch" disabled></x-dropdown>
                        </div>
                        <p>Contact your admin to modify this information</p>
                    </form>
            @endcan

            <hr>
            <form method="POST" action="/branches/{{$branch->id}}/staff/{{$user->id}}/password" class="update-password-container">
                <h2>Update password</h2>
                @csrf
                @method('PUT')
                <div class = "space-between">
                    <label for="current_password">Current password:</label>
                    <input type="password" name="current_password" class="input">
                </div>
                <div class = "space-between">
                    <label for="password">New password: </label>
                    <input type="password" name="password" class="input">
                </div>
                <div class = "space-between">
                    <label for="password">Confirm password: </label>
                    <input type="password" name="password_confirmation" class="input">
                </div>


                @error('password')
                {{ $message }}
                @enderror

                <button class="button-p" id="profile-button">Change password</button>
            </form>
        </div>
            @can('access-admin-pages')
                <hr>
                <div class="delete-button-container">
                <form method="POST" action="/branches/{{$branch->id}}/staff/{{$user->id}}">
                    @csrf
                    @method('DELETE')
                    <button name="delete" class="button-r" id="delete-profile-button">Delete account</button>
                </form>
            </div>
        @endcan
    </div>
</div>
</body>
