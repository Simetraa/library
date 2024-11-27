<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create book</title>
    <link rel="stylesheet" href="{{ asset('styles.css') }}"/>
</head>

<body>
<x-header></x-header>
<h1>Create book</h1>
<form method="POST" action="/books" autocomplete="off">
    @csrf

    <label for="title">Title</label>
    <input type="text" name="title"><br>


    <label for="author">Author</label>
    <input type="text" name="author"><br>


    <label for="cover_url">Cover</label>
    <input type="text" name="cover_url"><br>


    <label for="description">Description</label>
    <input type="text" name="description"><br>


    <label for="price">Price</label>
    <input type="number" min="0.01" step="0.01" name="price"><br>

    <label for="quantity">Quantity</label>
    <input type="number" min="0" name="quantity"><br>

    <button type="submit">Submit</button>
</form>
</body>

</html>
