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
                    <div id="search-container">
                        <input class="input" id="search-catalogue" type="text" name="search" placeholder="Search the catalogue" value="{{ $search ?? "" }}">
                        <button class="button-w" id="search-button">Search</button>
                    </div>


                    <div>
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

                        <button onclick="toggleFilters()" type="button" class="genres-button" id="genres-button">Genres</button>
                    </div>
                </div>
            </div>

            <p class = "search-count">{{$books->total()}} results</p>

            <div class="catalogue-container" id='book-list'>
                @foreach($books as $book)
                    <x-book :book="$book"></x-book>
                @endforeach

                @empty($books)
                    <p>No books found. Try removing some filters.</p>
                @endempty
            </div>
            {{ $books->appends(request()->all())->links('pagination::simple-default') }}
        </div>
        <x-categories :subjects="$subjects" :filters="$filters"></x-categories>
    </form>
<script>
    function toggleFilters() {
        document.getElementById('filters').classList.toggle('display-filters');
        document.getElementById('book-list').classList.toggle('display-catalogue');
    }
</script>
</body>

</html>
