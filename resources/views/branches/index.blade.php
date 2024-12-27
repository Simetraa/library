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
<div class="branch-container">
    <div class="header-row">
        <h1>Branches</h1>

        <a href="/branches/create" class="add-new-button">
            <span class="material-symbols-outlined">
                add
            </span>
            <span class="add-new-button-label">New</span>
        </a>

    </div>
    <div>
        @php
            $branches = Branch::all()
        @endphp

        @foreach($branches as $branch)
            <div class="branch-card">
                <h2><a href="/branches/{{$branch->id}}">Branch</a></h2>
                <p>Branch: {{ $branch->name }}</p>
                <p>Id: {{ $branch->id }}</p>
            </div>


        @endforeach
    </div>
</div>



</body>

</html>
