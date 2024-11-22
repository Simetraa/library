<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cat</title>
    <link rel = "stylesheet" href="{{ asset('styles.css') }}?ts=<?=time()?>"/>
    <link rel="stylesheet" href="{{ asset('mobile.css') }}?ts=<?=time()?>" media ="only screen and (max-width: 720px)"/>
</head>

<body class = "non-gradient-body">
    <x-header></x-header>
    <div class="container-centre">
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
            <div class="search-sort-by">
                <input type="text" placeholder="Search the catalogue">
{{--            <span><button onclick="" class = "list-button">List</button>--}}
                {{--            <button onclick="" class = "grid-button">Grid</button></span>--}}
                <div class = "search-options">
                    <select name="Sort by" id="dropdown">
                        <option value="relevance">Relevance</option>
                        <option value="price-low-high">Price: Low - High</option>
                        <option value="price-low-high">Price: High - Low</option>
                        <option value="title-alphabetical-az">Alphabetical: A - Z</option>
                        <option value="title-alphabetical-za">Alphabetical: Z - A</option>
                        <option value="date-latest">Date: Latest</option>
                        <option value="date-oldest">Date: Oldest</option>
                    </select>
                </div>
                <div class="filter-dropdown">
                    <select name="filter" id="dropdown">
                        <option value="fantasy">Fantasy</option>
                        <option value="history">History</option>
                        <option value="scifi">Sci-Fi</option>
                    </select>
                </div>
            </div>
            <div class="catalogue-container">

                @foreach($books as $book)
                    <x-book :book="$book"></x-book>
                @endforeach
            </div>
        </div>
    </div>
</body>

</html>
