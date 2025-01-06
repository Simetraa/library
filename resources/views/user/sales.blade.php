<!DOCTYPE html>
<html lang="en">
@php
    use App\Models\Branch;use Illuminate\Support\Facades\Auth;
@endphp

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Purchase History</title>
    <link rel="stylesheet" href="{{ asset('styles.css') }}?ts=<?=time()?>"/>
    <link rel="stylesheet" href="{{ asset('mobile.css') }}?ts=<?=time()?>" media="only screen and (max-width: 720px)"/>
</head>

<body class="non-gradient-body">
<x-header></x-header>
<div>

    @php
        $user = request()->user();
        $sales = $user->sales;
    @endphp

        <div class="sale-container">
            <h1>Purchases</h1>
            @foreach($sales as $sale)
            <div class="sale-card">
                <div class="sale-header">
                    <div class="sale-and-date">
                        <h2>Sale #{{ $sale->id }} </h2>
                        <p style="color: gray">{{$sale->created_at->format('d/m/y')}}</p>
                    </div>
                    <a href="/invoices/sales/{{$sale->id}}">Invoice ></a>
                </div>

                @foreach($sale->books as $book)
                    <div class="sale-book-info-pair">
                        <p>{{ $book->pivot->quantity }} x {{ $book->title }}</p>
                        <p>£ {{$book->pivot->price}}</p>
                    </div>
                @endforeach
                <hr>
                <div class="sale-total">
                    <p>Total:</p>
                    <p><span>£</span>{{$sale->totalPrice()}}</p>
                </div>
            </div>
            @endforeach
        </div>
</div>
</body>
