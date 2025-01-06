<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sale</title>
</head>

<body>
<h1>ATLAS Books</h1>
<h2>{{ $sale->branch->name }} - Sale #{{ $sale->id }}</h2>
    <div>
        <p style="color: gray">{{$sale->created_at->format('d/m/y')}}</p>
    </div>
    @foreach($sale->books as $book)
        <div >
            <p>{{ $book->pivot->quantity }} x {{ $book->title }}.... £{{$book->pivot->price * $book->pivot->quantity}}</p>
        </div>
    @endforeach
    <hr>
<p>Total: £{{$sale->totalPrice()}}</p>
</body>
</html>
