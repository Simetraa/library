@php use App\Models\Book; @endphp
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventory</title>
    <link rel="stylesheet" href="{{ asset('styles.css') }}"/>
    <script src="{{ asset('dropdown.js') }}" defer></script>
</head>

<body class="non-gradient-body">
<x-header></x-header>

@php

    $searchQuery = request('search') ?? '';
    $sortBy = request('sort-by');
    $sortOrder = 'asc';

    $books = $branch->books
        ->filter(function ($book) use ($searchQuery) {
            return false !== stripos($book->title, $searchQuery) || false !== stripos($book->author, $searchQuery);
        });

    switch ($sortBy) {
        case 'title-az':
            $books = $books->sortBy('title');
            break;
        case 'title-za':
            $books = $books->sortByDesc('title');
            break;
        case 'author-az':
            $books = $books->sortBy('author');
            break;
        case 'author-za':
            $books = $books->sortByDesc('author');
            break;
        case 'quantity-low-high':
            $books = $books->sortBy('pivot.quantity');
            break;
        case 'quantity-high-low':
            $books = $books->sortByDesc('pivot.quantity');
            break;
        default:
            $books = $books->sortBy('id');
            break;
    }
@endphp


<div class="sidebar-body">
    {{-- side bar --}}
    <x-dashboard-sidebar :branch="$branch"></x-dashboard-sidebar>
    <div class="branch-tables">
        <h1>{{$branch->name}} - Inventory</h1>
        <div class="space-between">
            <div class="inventory-inputs">
                <form action="/branches/{{$branch->id}}/inventory">
                    <input name="search" type="text" placeholder="Filter inventory..." value="{{request('search')}}">
                    <x-dropdown
                                autosubmit
                                name="sort-by"
                                :value="request('sort-by')"
                                :options="[
                    ['ID', 'id'],
                    ['Title: A-Z', 'title-az'],
                    ['Title: Z-A', 'title-za'],
                    ['Author: A-Z', 'author-az'],
                    ['Author: Z-A', 'author-za'],
                    ['Quantity: Low - High', 'quantity-low-high'],
                    ['Quantity: High - Low', 'quantity-high-low'],
                ]">
                    </x-dropdown>
                </form>
            </div>
            <a href="/books/create" class="add-new-button">
                    <span class="material-symbols-outlined">
                        add
                    </span>
                <span class="add-new-button-label">New</span>
            </a>
        </div>
        <div class="inventory-panes">
            <div class="inventory-book-pane">
                <table class="inventory-table">
                    <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Title</th>
                        <th scope="col">Author</th>
                        <th scope="col">Quantity</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($books as $book)
                        <tr>
                            <td id="book_id">{{ $book->id }}</td>
                            <td>{{ $book->title }}</td>
                            <td>{{ $book->author }}</td>
                            <td>{{ $book->pivot->quantity }}</td>
                            <td>
                                <a href="/branches/{{$branch->id}}/inventory/{{$book->id}}">
                                    <span class="material-symbols-outlined">inventory_2</span>
                                </a>
                            </td>
                            <td>
                                <form method="POST" action="/branches/{{$branch->id}}/inventory/{{$book->id}}">
                                    @csrf
                                    @method('DELETE')
                                    <button class="icon" type="submit" id="delete_button">
                                        <span class="material-symbols-outlined">delete</span>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                {{ $purchases->appends(request()->all())->links('pagination::simple-default') }}
            </div>

        </div>
    </div>
</div>

</body>

</html>
