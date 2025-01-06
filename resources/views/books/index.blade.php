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
    <div class="book-inventory-header">
        <h1>Index</h1>
        <div class="space-between">
            <div class="inventory-inputs">
                <form method="GET" action="/books">
                    <input type="text" placeholder="Title" name="title" value="{{ request('title') }}">
                    <input type="text" placeholder="Author" name="author" value="{{ request('author') }}">
                    <button type="submit">Search</button>
                </form>
            </div>
            <a href="/books/create" class="add-new-button">
            <span class="material-symbols-outlined">
                add
            </span>
                <span class="add-new-button-label">New</span>
            </a>
        </div>
    </div>


<div class="inventory-panes">
    <div class="inventory-book-pane">
        <table class="inventory-table">
            <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Title</th>
                <th scope="col">Author</th>
                <th scope="col">Cover Image</th>
                <th scope="col">Description</th>
                <th scope="col">Price</th>
            </tr>
            </thead>
            <tbody>
            @foreach($books as $book)
                <x-inventory-row :book="$book"></x-inventory-row>
            @endforeach
            </tbody>
        </table>
        {{ $books->appends(request()->all())->links('pagination::simple-default') }}
    </div>
</div>
</body>

</html>
