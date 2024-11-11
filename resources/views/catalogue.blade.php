<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cat</title>
    <link rel="stylesheet" href="{{ asset('styles.css') }}" />
</head>

<body>
    <x-header></x-header>
    <div class="flex-horizontal">
        <div class="filters-container">
            <h3>Genres:</h3>
            <input id="genre1" type="checkbox">
            <label for="genre1">Fantasy</label>
            <input id="genre2" type="checkbox">
            <label for="genre2">History</label>
            <input id="genre3" type="checkbox">
            <label for="genre3">Sci-Fi</label>
        </div>
        <div class="catalogue-container">
            @foreach($books as $book)
                <x-book :book="$book"></x-book>
            @endforeach
        </div>
    </div>
</body>

</html>
