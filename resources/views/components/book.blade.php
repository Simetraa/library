@props(["book"])

<div class="item-card">
    <img
        src="{{ $book["cover_url"] }}" alt="book cover">
    <h3>{{ $book["title"] }}</h3>
    <h4>{{ $book["author"] }}</h4>
</div>
