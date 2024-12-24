@php use App\Models\Branch; @endphp
    <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventory</title>
    <link rel="stylesheet" href="{{ asset('styles.css') }}"/>
</head>

<body class="non-gradient-body">
<x-header></x-header>
<div class="flex-horizontal">
    <h1>Dashboard - {{$branch->name}}</h1>
    <x-branches-dropdown :current-branch="$branch"></x-branches-dropdown>
</div>
    <div>
        <p>Branch: {{ $branch->name }}</p>
        <p>Id: {{ $branch->id }}</p>

        <a href="/branches/{{$branch->id}}/staff">Staff</a>
        <a href="/branches/{{$branch->id}}/inventory">Inventory</a>
        <a href="/branches/{{$branch->id}}/reservations">Reservations</a>
        <a href="/branches/{{$branch->id}}/sales">Sales</a>

        <form method="POST" action="/branches/{{$branch->id}}">
            @csrf
            @method('DELETE')
            <button type="submit">Delete</button>
        </form>

        <a href="/branches/{{$branch->id}}/edit">
            Edit
        </a>

        {{--DASHBOARD--}}
        <div class="top-selling-items-container">
            {{--        <style>--}}
            {{--            .time-selector {--}}
            {{--                display: flex;--}}
            {{--                justify-content: end;--}}
            {{--            }--}}
            {{--        </style>--}}
            {{--        <div class="time-selector">--}}
            {{--        <x-time-selector label='Time Selector' name="topSellingItemsPeriod" :topSellingItemsPeriod="$topSellingItemsPeriod"></x-time-selector>--}}
            {{--        </div>--}}

            <div class="dashboard-containers" id="sales-activity-container">
                <h2>Sales activity</h2>
                <p>Pending reservations: {{ $pendingReservations }}</p>
                <p>Collected reservations: {{ $collectedReservations }}</p>
            </div>
            <div class="dashboard-containers" id="top-sellers-container">
                <h2>Top Selling</h2>
                <div class="flex-horizontal">
                    @foreach($topSellingItems as $book)
                        <div>
                            <p>{{ $book->title }}</p>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="dashboard-containers" id="inventory-summary-container">
                <h2>Stock Status</h2>
                <p>Books in stock: {{ $booksInStockCount }}</p>
                <p>Books out of stock: {{ $booksOutOfStockCount }}</p>
            </div>
            <div class="dashboard-containers" id="purchase-sales-container">
                <h2>Sales</h2>
                <p>Quantity sold: {{$quantitySold}}</p>
                <p>Revenue: {{$totalRevenue}}</p>

                <h2>Purchases</h2>
                <p>Quantity ordered: </p>
                <p>Costs: </p>
            </div>
            <div class="dashboard-containers" id="chart">

            </div>
            {{--        create report and invoice button--}}

        </div>
    </div>
</body>

</html>
