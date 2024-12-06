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
    <div class="login-container">
        <h2>Log In</h2>
        <form method="POST" action="/login">
            @csrf

            <input type="email" name="email" class="form-input" placeholder="Email" required>
            <input type="password" name="password" class="form-input" placeholder="Password" required>
            <button type="submit" class="form-button">Login</button>
            <a href="/register" class="form-link">Dont have an account?</a>
        </form>
    </div>
</body>
</html>
