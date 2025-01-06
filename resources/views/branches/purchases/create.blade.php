<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sales</title>
    <link rel="stylesheet" href="{{ asset('styles.css') }}"/>

</head>

<template id="book-id-template">
    <span id="book-id-label"></span>
    <button id="book-id-cancel-button">Cancel</button>

</template>

<body class="non-gradient-body">
<x-header></x-header>

<div class="inventory-book-pane">
    <div class="bg-white-container add-purchase-container">
        <h1>{{ $branch->name }} - Manually Create Purchase</h1>
        <form method="POST" action="/branches/{{$branch->id}}/purchases">
            @csrf
            <input type="number" name="book_id" class="input new-purchase-input" min="0" placeholder="Book Id" required>
            <input type="number" name="quantity" class="input new-purchase-input" min="1" placeholder="Quantity" required>
            <input type="number" name="price" class="input new-purchase-input" min="0" step=".01" placeholder="Total price" required>
            <input type="text" name="supplier" class="input new-purchase-input" placeholder="Supplier" required>
            <button class="button-p form-button" id="profile-button">Add purchase</button>
        </form>
    </div>
</div>
</body>

</html>
