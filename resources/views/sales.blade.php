<!DOCTYPE html>
<html lang="en">
@php
    use App\Models\Branch;
@endphp

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Purchase History</title>
    <link rel="stylesheet" href="{{ asset('styles.css') }}?ts=<?=time()?>"/>
    <link rel="stylesheet" href="{{ asset('mobile.css') }}?ts=<?=time()?>" media ="only screen and (max-width: 720px)"/>
</head>

<body class="non-gradient-body">
<x-header></x-header>
<div>
    <h1>Purchases</h1>
    @php
        $user = Auth::user();
        $sales = $user->sales;
    @endphp

    @foreach($sales as $sale)
        <h2>Sale</h2>
        <p>Quantity: {{ $sale->quantity }}</p>
        <p>Branch: {{ $sale->branch->name }}</p>
        <p>Purchase date: {{ $sale->created_at }}</p>
        @foreach($sale->books as $book)
            <h3>{{ $book->title }}</h3>
            <p>{{ $book->author }}</p>
        @endforeach
    @endforeach
</div>
</body>
