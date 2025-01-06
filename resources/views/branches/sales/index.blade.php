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
<div class="sidebar-body">
    {{-- side bar --}}
    <x-dashboard-sidebar :branch="$branch"></x-dashboard-sidebar>
    <div class="branch-tables">
        <h1>{{$branch->name}} - Sales</h1>
        <div class="space-between">
            <div class="inventory-inputs">
                <form action="/branches/{{$branch->id}}/sales">
                    <input type="text" placeholder="Sale ID" name="sale-id" value="{{request('sale-id')}}">
                    <input type="text" placeholder="User ID" name="user-id" value="{{request('user-id')}}">
                    <input type="text" placeholder="Email" name="email" value="{{request('email')}}">
                    <x-dropdown id="dropdown"
                                name="sort-by"
                                :value="request('sort-by')"
                                :options="
[
    ['Price: Low - High', 'price-low-high'],
    ['Price: High - Low', 'price-high-low'],
    ['Time: Old - New', 'time-old-new'],
    ['Time: New - Old', 'time-new-old']
]"></x-dropdown>
                    <button type="submit">Search</button>
                </form>
            </div>
        </div>

        <div class="inventory-panes">
            <div class="inventory-book-pane">
                <table class="inventory-table">
                    <thead>
                    <tr>
                        <th scope="col">Sale ID</th>
                        <th scope="col">User ID</th>
                        <th scope="col">Email</th>
                        <th scope="col">Total Price</th>
                        <th scope="col">Date</th>
                        <th scope="col">Invoice</th>
                    </tr>
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
                            <td>£{{ $sale->totalPrice() }}</td>
                            <td>{{ $sale->created_at }}</td>
                            <td><a href="/invoices/sales/{{$sale->id}}">Generate</a></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                {{ $sales->appends(request()->all())->links('pagination::simple-default') }}

            </div>
        </div>
    </div>
</div>
</body>

</html>
