@php use App\Models\Book; @endphp
    <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Purchases</title>
    <link rel="stylesheet" href="{{ asset('styles.css') }}"/>
</head>

<body class="non-gradient-body">
<x-header></x-header>

<div class="sidebar-body">
    {{-- side bar --}}
    <x-dashboard-sidebar :branch="$branch"></x-dashboard-sidebar>
    <div class="branch-tables">
        <h1>{{$branch->name}} - Purchases</h1>
        <div class="space-between">
            <div class="inventory-inputs">
                <form action="/branches/{{$branch->id}}/purchases">
                    <input name="purchase-id" type="text" placeholder="Purchase ID" value="{{request('purchase-id')}}">
                    <input name="book-id" type="text" placeholder="Book ID" value="{{request('book-id')}}">
                    <input name="supplier" type="text" placeholder="Supplier" value="{{request('supplier')}}">

                    <x-dropdown id="dropdown"
                                name="sort-by"
                                :value="request('sort-by')"
                                :options="
    [
    ['Quantity Low - High', 'quantity-low-high'],
    ['Quantity High - Low', 'quantity-high-low'],
    ['Price: Low - High', 'price-low-high'],
    ['Price: High - Low', 'price-high-low'],
    ['Time: Old - New', 'time-old-new'],
    ['Time: New - Old', 'time-new-old']
]"></x-dropdown>
                    <button type="submit">Search</button>
                </form>
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
                    <tr>
                        <th scope="col">Purchase ID</th>
                        <th scope="col">Book ID</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Total Price</th>
                        <th scope="col">Time</th>
                        <th scope="col">Supplier</th>
                        <th scope="col">Invoice</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($purchases as $purchase)
                        <tr>
                            <td>{{ $purchase->id }}</td>
                            <td>{{ $purchase->book->id }}</td>
                            <td>{{ $purchase->quantity }}</td>
                            <td>{{ $purchase->price }}</td>
                            <td>{{ $purchase->created_at }}</td>
                            <td>{{ $purchase->supplier }}</td>
                            <td><a href="/invoices/purchases/{{$purchase->id}}">Generate</a></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                {{ $purchases->appends(request()->all())->links('pagination::simple-default') }}
            </div>
        </div>
    </div>
</div>
</body>

</html>
