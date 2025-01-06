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

<div class="branch-container">
    <div class="header-row">
        <h1>Branches</h1>
        @can('access-admin-pages')
            <a href="/branches/create" class="add-new-button">
            <span class="material-symbols-outlined">
                add
            </span>
                <span class="add-new-button-label">New</span>
            </a>
        @endcan
    </div>
    <div>
        @php
            $branches = Branch::all()
        @endphp

        @foreach($branches as $branch)
            <div class="branch-card">
                <div>
                    <h3>{{ $branch->name }} - #{{ $branch->id }}</h3>
                </div>
                <div>
                    <h3><a href="/branches/{{$branch->id}}">Manage Branch</a></h3>
                </div>
            </div>


        @endforeach
    </div>
</div>
{{--<div class="header-row">
    <h1>Branches</h1>
    @can('access-admin-pages')
        <a href="/branches/create" class="add-new-button">
                <span class="material-symbols-outlined">
                    add
                </span>
                <span class="add-new-button-label">New</span>
        </a>
    @endcan
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

</div>--}}



</body>

</html>
