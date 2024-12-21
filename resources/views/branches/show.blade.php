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
    <h1>Branch</h1>
</div>
    <div>
        <h2>Branch</h2>
        <p>Branch: {{ $branch->name }}</p>
        <p>Id: {{ $branch->id }}</p>

        <form method="POST" action="/branches/{{$branch->id}}">
            @csrf
            @method('DELETE')
            <button type="submit">Delete</button>
        </form>

        <a href="/branches/{{$branch->id}}/edit">
            Edit
        </a>
    </div>
</body>

</html>
