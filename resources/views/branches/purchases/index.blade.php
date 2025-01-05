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
    $purchases = $branch->purchases;
@endphp
<div class="sidebar-body">
    {{-- side bar --}}
    <x-dashboard-sidebar :branch="$branch"></x-dashboard-sidebar>
    <div class="branch-tables">
        <h1>{{$branch->name}} - Purchases</h1>
        <div class="space-between">
            <div class="inventory-inputs">
                <input type="text" placeholder="Filter Purchases...">
            </div>
            <a href="purchases/create" class="add-new-button">
            <span class="material-symbols-outlined">
                add
            </span>
                <span class="add-new-button-label">New</span>
            </a>
        </div>

        <div class="inventory-panes">
            <div class="inventory-book-pane">
                <table class="inventory-table">
                    <thead>
                    <th scope="col">Purchase ID</th>
                    <th scope="col">Book ID</th>
                    <th scope="col">Quantity</th>
                    <th scope="col">Total Price</th>
                    </thead>
                    <tbody>
                    @foreach($purchases as $purchase)
                        <tr>
                            <td>
                                <a href="/branches/{{$branch->id}}/purchases/{{$purchase->id}}">
                                    {{ $purchase->id }}
                                </a>
                            </td>
                            <td>{{ $purchase->id }}</td>
                            <td>{{ $purchase->book->id }}</td>
                            <td>{{ $purchase->quantity }}</td>
                            <td>{{ $purchase->price }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
</body>

</html>
