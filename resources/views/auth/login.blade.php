<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log In</title>
    <link rel = "stylesheet" href="{{ asset('styles.css') }}?ts=<?=time()?>"/>
    <link rel="stylesheet" href="{{ asset('mobile.css') }}?ts=<?=time()?>" media ="only screen and (max-width: 720px)"/>


</head>
<body class="gradient-body">
    <x-header></x-header>
    <div class="bg-white-container" id="login-container">
        <h2>Log In</h2>
        <form method="POST" action="/login">
            @csrf

            <input type="email" name="email" class="input form-input" placeholder="Email" value="{{old('email')}}" required>
            <input type="password" name="password" class="input form-input" placeholder="Password" required>
            @error('email')
                <p class="form-error">Email and password do not match</p>
            @enderror
            <button type="submit" class="button-p" id="form-button">Login</button>
            <a href="/register" class="form-link">Dont have an account?</a>
        </form>
    </div>
</body>
</html>
