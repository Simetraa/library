@props(["book"])
<a class="item-link" href="books/{{ $book->id }}">
    <div class="item-card">
        <img src="{{ $book->cover_url }}" alt="book cover">
        <h3>{{ $book->title }}</h3>
        <h4>{{ $book->author }}</h4>

        <div class="flex-horizontal-spaced">
        @if($book->quantity == 0)
            <span>Stock: 🔴</span>
        @elseif($book->quantity >= 10)
            <span>Stock: 🟡</span>
        @else
             <span>Stock: 🟢</span>
        @endif
            <span>{{ $book->getPrice() }}</span>
        </div>
    </div>
</a>


{{--switch statement improvement--}}
{{--https://stackoverflow.com/a/24813225--}}
