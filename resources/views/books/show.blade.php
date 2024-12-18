<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book</title>
    <link rel="stylesheet" href="{{ asset('styles.css') }}?ts=<?=time()?>"/>
    <link rel="stylesheet" href="{{ asset('mobile.css') }}?ts=<?=time()?>" media ="only screen and (max-width: 720px)"/>

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

                @php
                    use App\Models\Branch;

                    $branches = Branch::getBranches();
//                    $defaultValue = Branch::first()->id ?? Auth::user()->branch->id;
                    $defaultValue = request()->user()->branch->id ?? Branch::first()->id;
                @endphp
                @auth
                <div class="book-info" id = "reserve-container">
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
                                <x-dropdown  name="branch_id"
                                             :options="$branches"
                                             :value="$defaultValue"
                                             id="reserve-dropdown">
                                </x-dropdown>
                            </div>
                            <button>Reserve</button>
                        </div>
                    </form>
                </div>
                @endauth
            </div>
        </div>
</body>
</html>
