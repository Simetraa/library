<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create book</title>
    <link rel="stylesheet" href="{{ asset('styles.css') }}"/>
</head>

<body class="non-gradient-body">
<x-header></x-header>
<div class="container-centre">
    <div class="book-container">
        <h1>Create book</h1>
        <form method="POST" action="/books" autocomplete="off">
            @csrf
            <div class = "book-input-field">
                <label for="title">Title</label>
                <input type="text" name="title">
            </div>
            <div class = "book-input-field">

                <label for="author">Author</label>
                <input type="text" name="author">
            </div>
            <div class = "book-input-field">

                <label for="cover_url">Cover</label>
                <input type="text" name="cover_url">
            </div>
            <div class = "book-input-field">

                <label for="description">Description</label>
                <input type="text" name="description">
            </div>
            <div class = "book-input-field">

                <label for="price">Price</label>
                <input type="number" min="0.01" step="0.01" name="price">
            </div>
            <div class = "book-input-field">

                <label for="quantity">Quantity</label>
                <input type="number" min="0" name="quantity">
            </div>
            <button type="submit" class = "edit-create-button">Submit</button>
        </form>
    </div>
</div>
</form>
</body>

</html>
