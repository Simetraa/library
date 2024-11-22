<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BOOK</title>
    <link rel="stylesheet" href="{{ asset('styles.css') }}?ts=<?=time()?>" />
</head>

<body class = "non-gradient-body">
<x-header></x-header>
    <div class="book-page">
        <div class="book-cover">

                <img src="{{ $book["cover_url"] }}" alt="book cover">
            </div>

        <div class="book-info-container">
            <div class="book-info" id="book-title">
                <p>{{ $book["title"] }}</p>
            </div>
            <div class="book-info">
                <p>{{ $book["author"] }}</p>
            </div>
            <div class="book-info">
                <p>{{ $book["description"] }}</p>
            </div>
            <div class = "stock-info">
                <div class="book-info">
                    <p>Price: {{ $book->getPrice() }}</p>
                </div>
                <div class="book-info">
                    <p>Quantity: {{ $book["quantity"] }}</p>
                </div>
            </div>

        </div>

    </div>
</body>

</html>
