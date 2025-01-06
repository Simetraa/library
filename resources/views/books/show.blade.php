<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book</title>
    <link rel="stylesheet" href="{{ asset('styles.css') }}"/>
    <link rel="stylesheet" href="{{ asset('mobile.css') }}" media="only screen and (max-width: 720px)"/>

</head>

<body class="non-gradient-body">
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

        @php
            use App\Models\Branch;use Illuminate\Support\Facades\Auth;

            $branches = Branch::getBranches();
            $defaultValue = Auth::user()->branch->id ?? Branch::first()->id;
        @endphp

        @if(!$book->visible)
            <div class="book-info form-error caps">
                <p>
                    This book is no longer available
                </p>
            </div>
        @else
            <div class="stock-info">
                <div class="book-info">
                    <p>Price: {{ $book->getPrice() }}</p>
                </div>
                <div class="book-info">
                    <p>Quantity: {{ $book->getTotalQuantity() }}</p>
                </div>
            </div>

            @auth
                @can('access-user-pages')
                <div class="book-info" id="reserve-container">
                    <h3>Reserve this book</h3>
                    <form action="/reservations" method="POST">
                        @csrf
                        <div id="reserve-container-inputs">
                            <div>
                                <input type="hidden" name="book_id" value="{{ $book->id }}">
                                <label for="quantity">Quantity:</label>
                                <input name="quantity" value="1" type="number" min="1" class="text-input-field">
                            </div>
                            <div>
                                <label for="location">Collect at:</label>
                                <x-dropdown name="branch_id"
                                            :options="$branches"
                                            :value="$defaultValue"
                                            id="reserve-dropdown">
                                </x-dropdown>
                            </div>
                            <button class="button-p" type="submit">Reserve</button>
                        </div>
                    </form>
                </div>
                @endcan
            @endauth
        @endif
    </div>
</div>
</body>
</html>
