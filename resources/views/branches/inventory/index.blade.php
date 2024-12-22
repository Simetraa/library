@php use App\Models\Book; @endphp
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventory</title>
    <link rel="stylesheet" href="{{ asset('styles.css') }}"/>
</head>

<body class="non-gradient-body">
<x-header></x-header>

@php
    $books = $branch->books;
@endphp

<div class="flex-horizontal">
    <h1>{{ $branch->name }} - Inventory</h1>
    <input type="text" placeholder="Filter inventory...">


    <a href="/books/create">
            <span class="material-symbols-outlined">
                add_circle
            </span>
    </a>
    <x-branches-dropdown :current-branch="$branch"></x-branches-dropdown>
</div>
<div class="inventory-panes">
    <div class="inventory-book-pane">
        <table class="inventory-table">
            <thead>
            <th scope="col">ID</th>
            <th scope="col">Title</th>
            <th scope="col">Author</th>
            <th scope="col">Quantity</th>
            </thead>
            <tbody>
            @foreach($books as $book)
                <tr>
                    <td>{{ $book->id }}</td>
                    <td>{{ $book->title }}</td>
                    <td>{{ $book->author }}</td>
                    <td>{{ $book->pivot->quantity }}</td>
                    <td>
                        <form method="POST" action="/branches/{{$branch->id}}/inventory/{{$book->id}}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" id="delete_button">
                                <span class="material-symbols-outlined">delete</span>
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
</body>

</html>
