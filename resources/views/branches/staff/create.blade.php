@php use App\Models\Branch; @endphp
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Staff</title>
    <link rel="stylesheet" href="{{ asset('styles.css') }}"/>

</head>

<body class="non-gradient-body">
<x-header></x-header>

<div class="inventory-panes">
    <div class="inventory-book-pane">
        <div class="sale-container">
            <h1>{{ $branch->name }} - Create Staff Member</h1>
            <form method="POST" action="/branches/{{$branch->id}}/staff">
                @csrf
                <input type="email" name="email" class="form-input" placeholder="Email" value="{{old('email')}}" required>
                <input type="password" name="password" class="form-input" placeholder="Password" required>
                <input type="password" name="password_confirmation" class="form-input" placeholder="Re-enter password" required>
                @error('password')
                <p class="form-error">Passwords do not match</p>
                @enderror

                <button class="form-button">Create staff</button>
            </form>
        </div>
    </div>
</div>
</body>

</html>
