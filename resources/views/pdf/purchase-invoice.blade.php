<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Purchase</title>
</head>

<body>
<h1>ATLAS Books</h1>
<h2>{{ $purchase->branch->name }} - Purchase #{{ $purchase->id }}</h2>
<div>
    <p style="color: gray">{{$purchase->created_at->format('d/m/y')}}</p>
</div>
<p>{{ $purchase->quantity }} x {{ $purchase->book->title }}</p>
<p>Supplier: {{$purchase->supplier}}</p>
<hr>
<p>Total: £{{$purchase->price}}</p>
</body>
</html>
