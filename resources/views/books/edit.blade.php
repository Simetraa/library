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

<div class = "container-centre">
    <div class="book-cover">
        <img src="{{ $book["cover_url"] }}" alt="book cover">
    </div>
    <div class="book-container">

        <h1>Edit book</h1>
            <form method="POST" action="/books/{{$book["id"]}}" autocomplete="off">
                @csrf
                @method("PATCH")

                <div class = "book-input-field">
                    <label for="id">Id</label>
                    <input readonly value="{{ $book["id"] }}" type="text" name="id" disabled>
                </div>
                <div class = "book-input-field">
                    <label for="title">Title:</label>
                    <input value="{{ $book["title"] }}" type="text" name="title">
                </div>
                <div class = "book-input-field">
                    <label for="author">Author:</label>
                    <input value="{{ $book["author"] }}" type="text" name="author">
                </div>
                <div class = "book-input-field">
                    <label for="cover_url">Cover:</label>
                    <input value="{{ $book["cover_url"] }}" type="text" name="cover_url">
                </div>
                <div class = "book-input-field">
                    <label for="description">Description:</label>
                    <input value="{{ $book["description"] }}" type="text" name="description">
                </div>
                <div class = "book-input-field">
                    <label for="price">Price (£):</label>
                    <input value={{$book["price"]}} type="number" min="1" step="any" name="price">
                </div>
                <div class = "book-input-field">
                    <label for="quantity">Quantity:</label>
                    <input value={{$book["quantity"]}} type="number" min="0" name="quantity">
                </div>
                    <button class="edit-create-button">Submit</button>
        </form>
    </div>
</div>
</body>

</html>
