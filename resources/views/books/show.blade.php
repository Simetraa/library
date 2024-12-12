<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book</title>
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

        @php
            use App\Models\Branch;

            $branches = Branch::getBranches();
            $defaultValue = Branch::first()->id; // Auth::user()->branch->id ??
        @endphp

        <form action="/reservations" method="POST">
            @csrf
            <fieldset>
                <legend>Reserve book</legend>
                <input type="hidden" name="book_id" value="{{ $book->id }}">
                    <label for="quantity">Quantity</label>
                    <input name="quantity" value="1" type="number">

                    <x-dropdown name="branch_id" :options="$branches" :value="$defaultValue"></x-dropdown>
                    <button>Reserve</button>
            </fieldset>
        </form>

    </div>
</body>

</html>
