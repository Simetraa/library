<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventory</title>
    <link rel="stylesheet" href="{{ asset('styles.css') }}"/>
</head>

<body>
<x-header></x-header>
<h1>Edit book</h1>
<form method="POST" action="/books/{{$book["id"]}}" autocomplete="off">
    @csrf
    @method("PATCH")

    <label for="id">Id</label>
    <input readonly value="{{ $book["id"] }}" type="text" name="id"><br>


    <label for="title">Title</label>
    <input value="{{ $book["title"] }}" type="text" name="title"><br>


    <label for="author">Author</label>
    <input value="{{ $book["author"] }}" type="text" name="author"><br>


    <label for="cover_url">Cover</label>
    <input value="{{ $book["cover_url"] }}" type="text" name="cover_url"><br>


    <label for="description">Description</label>
    <input value="{{ $book["description"] }}" type="text" name="description"><br>


    <label for="price">Price</label>
    <input value={{$book["price"]}} type="number" min="1" step="any" name="price"><br>

    <label for="quantity">Quantity</label>
    <input value={{$book["quantity"]}} type="number" min="0" name="quantity"><br>

    <button type="submit">Submit</button>
</form>
</body>

</html>
