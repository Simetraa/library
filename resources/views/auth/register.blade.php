@php use App\Models\Branch; @endphp
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel = "stylesheet" href="{{ asset('styles.css') }}?ts=<?=time()?>"/>
    <link rel="stylesheet" href="{{ asset('mobile.css') }}?ts=<?=time()?>" media ="only screen and (max-width: 720px)"/>
</head>
<body class="gradient-body">
    <x-header></x-header>
    <div class="sign-up-container">
        <h2>Register</h2>
        <form method="POST" action="/register">
            @csrf
            <input type="email" name="email" class="form-input" placeholder="Email" value="{{old('email')}}" required>
            <input type="password" name="password" class="form-input" placeholder="Password" required>
            <input type="password" name="password_confirmation" class="form-input" placeholder="Re-enter password" required>
            @error('password')
                <p class="form-error">Passwords do not match</p>
            @enderror
            @php
                $currentBranch = Branch::first()->id;
                $branches = Branch::getBranches();
            @endphp
            <label for="branch">Select a branch: </label>
            <x-dropdown name="branch_id" :options="$branches" :value="$currentBranch"></x-dropdown>
            @error('branch_id')
            {{ $message }}
            @enderror

            <button class="form-button">Register</button>
        </form>
        <form>
            <a href="/login" class="form-link">Already have an account?</a>
        </form>
    </div>
</body>
</html>
