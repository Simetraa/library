<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sales</title>
    <link rel="stylesheet" href="{{ asset('styles.css') }}"/>
    <script src="{{ asset('checkout.js')}}" defer></script>

</head>

<template id="book-id-template">
    <span id="book-id-label"></span>
    <button id="book-id-cancel-button">Cancel</button>

</template>

<body class="non-gradient-body">
<x-header></x-header>

<div class="inventory-book-pane">
    <div class="sale-container">
        <h1>{{ $branch->name }} - Manually Create Purchase</h1>
        <form method="POST" action="/branches/{{$branch->id}}/purchases">
            @csrf
            <input type="number" name="book_id" class="form-input" placeholder="Book_Id" required>
            <input type="number" name="quantity" class="form-input" placeholder="Quantity" required>
            <input type="number" name="price" class="form-input" placeholder="Total price" required>
            <input type="text" name="supplier" class="form-input" placeholder="Supplier" required>
            
            <button class="form-button">Add purchase</button>
        </form>
        <div id="book-id-list"></div>
    </div>
</div>
</body>

</html>
