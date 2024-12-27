@php use App\Models\Branch; @endphp
    <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventory</title>
    <link rel="stylesheet" href="{{ asset('styles.css') }}"/>
    <link rel="stylesheet" href="{{ asset('mobile.css') }}?ts=<?=time()?>" media ="only screen and (max-width: 720px)"/>

</head>

<body class="non-gradient-body">
<x-header></x-header>
<div class="create-branch-container">
    <div class="create-branch-card">
        <h1>Create Branch</h1>
        <div>
            <form method="POST" action="/branches" autocomplete="off">
                @csrf

                <div class="branch-input-field">
                    <label for="name">Branch Name:</label>
                    <input type="text" name="name" id="name" required>
                </div>
                <button type="submit" class="edit-create-button-branch">Submit</button>
            </form>
        </div>
    </div>
</div>

</body>

</html>
