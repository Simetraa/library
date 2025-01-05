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
<div class="sidebar-body">
    {{-- side bar --}}
    <x-dashboard-sidebar :branch="$branch"></x-dashboard-sidebar>
    <div class="branch-tables">
        <h1>{{$branch->name}} - Sales</h1>
        <div class="space-between">
            <div class="inventory-inputs">
                <input type="text" placeholder="Filter Sales...">
            </div>
            <a href="sales/create" class="add-new-button">
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
                        <th scope="col">Sale ID</th>
                        <th scope="col">User ID</th>
                        <th scope="col">Email</th>
                        <th scope="col">Total Price</th>
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
                            <td>{{ $sale->totalPrice() }}</td>
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
