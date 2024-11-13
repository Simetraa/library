<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BOOK</title>
    <link rel="stylesheet" href="{{ asset('styles.css') }}" />
</head>

<body>
<x-header></x-header>
<div>
    <img src="{{ $book["cover_url"] }}" alt="book cover">

    <p>{{ $book["title"] }}</p>
    <p>{{ $book["author"] }}</p>
    <p>{{ $book["description"] }}</p>
    <p>Price: {{ $book->getPrice() }}</p>
    <p>Quantity: {{ $book["quantity"] }}</p>
</div>
</body>

</html>
