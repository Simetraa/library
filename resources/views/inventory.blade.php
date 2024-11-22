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
<h1>Inventory</h1>
<div class="inventory-panes">
    <div class="inventory-book-pane">
        <table>
            <thead>
                <th scope="col"><input type="checkbox"></th>
                <th scope="col">ID</th>
                <th scope="col">Title</th>
                <th scope="col">Author</th>
                <th scope="col">Cover Image</th>
                <th scope="col">Description</th>
                <th scope="col">Price</th>
                <th scope="col">Quantity</th>
            </thead>
            <tbody>
            @foreach($books as $book)
                <x-inventory-row :book="$book"></x-inventory-row>
            @endforeach
            </tbody>
        </table>
    </div>
    <div>
        <form autocomplete="off">
            <label for="id">ID</label>
            <input type="text" name="id">


            <label for="title">Title</label>
            <input type="text" name="title">


            <label for="author">Author</label>
            <input type="text" name="author">


            <label for="cover">Cover</label>
            <input type="text" name="cover">


            <label for="description">Description</label>
            <input type="text" name="description">


            <label for="price">Price</label>
            <input type="number" min="1" step="any" name="price">



        </form>
    </div>
</div>
</body>

</html>
