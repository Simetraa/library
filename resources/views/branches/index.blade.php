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
    <h1>Branches</h1>
    <a href="/branches/create">
            <span class="material-symbols-outlined">
                add_circle
            </span>
    </a>
</div>
<div>
    @php
        $branches = Branch::all()
 @endphp

    @foreach($branches as $branch)
        <h2><a href="/branches/{{$branch->id}}">Branch</a></h2>
        <p>Branch: {{ $branch->name }}</p>
        <p>Id: {{ $branch->id }}</p>
    @endforeach
</div>
</body>

</html>
