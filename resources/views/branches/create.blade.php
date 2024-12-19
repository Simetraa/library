@php use App\Models\Branch; @endphp
    <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventory</title>
    <link rel="stylesheet" href="{{ asset('styles.css') }}"/>
</head>

<body class="non-gradient-body">
<x-header></x-header>
<div class="flex-horizontal">
    <h1>Create Branch</h1>
</div>
<div>
    <form method="POST" action="/branches" autocomplete="off">
        @csrf

        <label for="name">Branch Name</label>
        <input type="text" name="name" id="name" required>

        <button type="submit">Submit</button>
    </form>
    </div>
</body>

</html>
