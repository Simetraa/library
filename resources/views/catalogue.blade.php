<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catalogue</title>
    <link rel="stylesheet" href="{{ asset('styles.css') }}?ts=<?=time()?>"/>
    <link rel="stylesheet" href="{{ asset('mobile.css') }}?ts=<?=time()?>" media ="only screen and (max-width: 720px)"/>
    <script src="{{ asset('preserve_scroll.js') }}"></script>
    <script src="{{ asset('filters.js')}}" defer></script>
</head>

<body class="non-gradient-body">
    <x-header></x-header>
    <form class="container-row-reverse" action="/">
        <div>
            <div id='search' class="search-results">
                <div class="search-sort-by">
                    <div class="search-options">
                        <input type="text" name="search" placeholder="Search the catalogue" value="{{ $search ?? "" }}">
                        <button class="search-button" id="">Search</button>
                    </div>


                    <div class="search-options">

                        <x-dropdown id="dropdown"
                                    name="sort-by"
                                    :value="request()->get('sort-by')"
                                    :options="
[
    ['Relevance', 'relevance'],
    ['Price: Low - High', 'price-low-high'],
    ['Price: High - Low', 'price-high-low'],
    ['Author: A-Z', 'author-az'],
    ['Author: Z-A', 'author-za'],
    ['Title: A-Z', 'title-az'],
    ['Title: Z-A', 'title-za'],
    ['Date: Latest', 'date-latest'],
    ['Date: Oldest', 'date-oldest']
]"></x-dropdown>

                        <button onclick="hideshowfilters()" type="button" class="genres-button" id="genres-button">Genres</button>
                    </div>
                </div>
            </div>

            <p class = "search-count">{{$books->count()}} results</p>

            <div class="catalogue-container" id='book-list'>
                @foreach($books as $book)
                    <x-book :book="$book"></x-book>
                @endforeach
            </div>
        </div>
        <x-categories :subjects="$subjects" :filters="$filters"></x-categories>
    </form>
<script>
    // var filterbox = document.getElementById('filters');
    // var search = document.getElementById('search');
    // var display = 0;

    function hideshowfilters() {
        // if (display == 0) {
        //     filterbox.style.display = 'block';
        //     search.style.display = 'none';
        //     display = 1;
        // } else {
        //     filterbox.style.display = 'none';
        //     search.style.display = 'block';
        //     display = 0;
        // }
        document.getElementById('filters').classList.toggle('display-filters');
        document.getElementById('book-list').classList.toggle('display-catalogue');
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
