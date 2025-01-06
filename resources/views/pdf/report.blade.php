@php use App\Models\Sale; @endphp
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Report</title>
</head>

<body>
<h1>ATLAS Books</h1>
<h2>{{ $branch->name }} - Report</h2>
<div>
    <p style="color: gray">{{now()->format('d/m/y')}}</p>
</div>
<h3>Sales</h3>
    @foreach($branch->sales as $sale)
         <p>#{{ $sale->id }} | user:{{ $sale->user->id }}.... £{{$sale->totalPrice()}}</p>
    @endforeach
<hr>
<h3>Purchases</h3>
    @foreach($branch->purchases as $purchase)
        <p>#{{ $purchase->id }} | supplier: {{$purchase->supplier}} | {{ $purchase->book->title }} x {{ $purchase->quantity }}.... £{{$purchase->price}}</p>
    @endforeach
<hr>
@php
    $revenue = $branch->sales->sum(function (Sale $sale) {
            return $sale->totalPrice();
        });
    $cost = $branch->purchases->sum('price');
@endphp
<h3>Profit summary</h3>
<p>Revenue: £{{$revenue}}</p>
<p>Cost: £{{$cost}}</p>
<p>Profit: £{{$revenue - $cost}}</p>
</body>
</html>
