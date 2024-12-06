<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catalogue</title>
    <link rel = "stylesheet" href="{{ asset('styles.css') }}?ts=<?=time()?>"/>
    <link rel="stylesheet" href="{{ asset('mobile.css') }}?ts=<?=time()?>" media ="only screen and (max-width: 720px)"/>
{{--    <script src="{{ assert('styles.css') }}"></script>--}}
    <script src="{{ asset('preserve_scroll.js') }}"></script>
    <script src="{{ asset('filters.js')}}" defer></script>


</head>

<body class = "non-gradient-body">
{{--<p>{{ dd($genreNames) }}</p>--}}
    <x-header></x-header>
    <div class="container-centre">


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
                    <button onclick="hideshowfilters()" class = "genres-button" id = "genres-button">Genres</button>
                </div>
            </div>
        </div>

            <div class="catalogue-container">

                @foreach($books as $book)
                    <x-book :book="$book"></x-book>
                @endforeach
            </div>
        <x-categories :subjects="$subjects" :filters="$filters"></x-categories>
    </div>
<script>
    var filterbox = document.getElementById('filters');
    var search = document.getElementById('search');
    var display = 0;

    function hideshowfilters() {
        if (display == 0) {
            filterbox.style.display = 'block';
            search.style.display = 'none';
            display = 1;
        }
        else {
            filterbox.style.display = 'none';
            search.style.display = 'block';
            display = 0;
        }


    // document.getElementById('genres-button').addEventListener('click', function (){
    //     var pagecontent = document.getElementById('search');
    //     var filters = document.getElementById('filters');
    //     if (filters.style.display === 'none') {
    //         filters.style.display = 'block'
    //         pagecontent.style.display = 'none';
    //     }
    //     else {
    //         filters.style.display = 'none'
    //         pagecontent.style.display = 'none';
    //     }
    // });

</script>
</body>

</html>
