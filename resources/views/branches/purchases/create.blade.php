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

<div class="inventory-panes">
    <div class="inventory-book-pane">
        <div class="sale-container">
            <h1>{{ $branch->name }} - Manually Create Purchase</h1>
            <form id="book-id-input">
                <input id="">
            </form>
            <div id="book-id-list"></div>
        </div>
    </div>
</div>
</body>

</html>
