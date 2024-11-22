<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cat</title>
    <link rel="stylesheet" href="{{ asset('styles.css') }}?ts=<?=time()?>" />
</head>

<body class = "non-gradient-body">
    <x-header></x-header>
    <div class="flex-horizontal">
        <div class="filters-container">
            <h3>Genres:</h3>
            <span><input id="genre1" type="checkbox">
            <label for="genre1">Fantasy</label></span>
            <span><input id="genre2" type="checkbox">
            <label for="genre2">History</label></span>
            <span><input id="genre3" type="checkbox">
            <label for="genre3">Sci-Fi</label></span>

        </div>
        <div class = "search-results">
            <input type="text" placeholder="Search the catalogue">
            <span><button onclick="" class = "list-button">List</button>
            <button onclick="" class = "grid-button">Grid</button></span>

            <div class="catalogue-container">

                @foreach($books as $book)
                    <x-book :book="$book"></x-book>
                @endforeach
            </div>
        </div>
    </div>
</body>

</html>
