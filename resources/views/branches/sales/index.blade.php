@php use App\Models\Book; @endphp
    <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sales</title>
    <link rel="stylesheet" href="{{ asset('styles.css') }}"/>
</head>

<body class="non-gradient-body">
<x-header></x-header>

@php
    $sales = $branch->sales;
@endphp

<div class="flex-horizontal">
    <h1>{{ $branch->name }} - Sales</h1>
    <input type="text" placeholder="Filter Sales...">
    <a href="sales/create">
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
            <th scope="col">Sale ID</th>
            <th scope="col">User ID</th>
            <th scope="col">Email</th>
            <th scope="col">Total Price</th>
            </thead>
            <tbody>
            @foreach($sales as $sale)
                    <tr>
                        <td>
                            <a href="/branches/{{$branch->id}}/sales/{{$sale->id}}">
                                {{ $sale->id }}
                            </a>
                            </td>
                        <td>{{ $sale->user->id }}</td>
                        <td>{{ $sale->user->email }}</td>
                        <td>{{ $sale->totalPrice() }}</td>
                    </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
</body>

</html>
