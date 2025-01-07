<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sales</title>
    <link rel="stylesheet" href="{{ asset('styles.css') }}"/>
</head>

<body class="non-gradient-body">
<x-header></x-header>
<div class="sale-container">
    <h1>{{ $sale->branch->name }} - Sale #{{ $sale->id }}</h1>

    <div class="sale-card">
        <div class="sale-header">
            <div class="sale-and-date">
                <p style="color: gray">{{$sale->created_at->format('d/m/y')}}</p>
            </div>
            <a href="/invoices/sales/{{$sale->id}}">Invoice ></a>
        </div>
        @foreach($sale->books as $book)
            <div class="sale-book-info-pair">
                <p>{{ $book->pivot->quantity }} x {{ $book->title }}</p>
                <p>£{{$book->pivot->price * $book->pivot->quantity}}</p>
                <p>Returned: <span
                            class="material-symbols-outlined">{{$book->pivot->returned ? "check" : "close"}}</span></p>

            </div>
        @endforeach
        <hr>
        <div class="sale-total">
            <p>Total</p>
            <p>£{{$sale->totalPrice()}}</p>
        </div>
    </div>
</div>
</body>

</html>
