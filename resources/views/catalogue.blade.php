<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catalogue</title>
    <link rel = "stylesheet" href="{{ asset('styles.css') }}?ts=<?=time()?>"/>
    <link rel="stylesheet" href="{{ asset('mobile.css') }}?ts=<?=time()?>" media ="only screen and (max-width: 720px)"/>
</head>

<body class = "non-gradient-body">
{{--<p>{{ dd($genreNames) }}</p>--}}
    <x-header></x-header>
    <div class="container-centre">
        <x-categories :subjects="$subjects" :filters="$filters"></x-categories>

        <div id = 'search' class = "search-results">
            <div class="search-sort-by">
                <input type="text" placeholder="Search the catalogue">
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
                    <button onclick="hideshowfilters()" class = "genres-button">Genres</button>
                </div>
            </div>
        </div>
            <div class="catalogue-container">

                @foreach($books as $book)
                    <x-book :book="$book"></x-book>
                @endforeach
            </div>
    </div>
<script>
    var filterbox = document.getElementById('filters');
    var pagecontent = document.getElementById('search');
    var display = 0;

    function hideshowfilters() {
        if (display == 1) {
            filterbox.style.display = 'block';
            pagecontent.style.display = 'none';
            display = 0;
        }
        else {
            filterbox.style.display = 'none';
            pagecontent.style.display = 'block';
            display = 1;
        }
    }

</script>
</body>

</html>
