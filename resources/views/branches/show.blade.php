@php use App\Models\Branch; @endphp
    <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="{{ asset('styles.css') }}"/>
</head>

<body class="non-gradient-body">
<x-header></x-header>

<div class="dashboard">
    {{-- side bar --}}
    <x-dashboard-sidebar :branch="$branch"></x-dashboard-sidebar>

    {{--DASHBOARD--}}
    <div class="dashboard-body">
        {{-- time selector --}}
        {{--        <style>--}}
        {{--            .time-selector {--}}
        {{--                display: flex;--}}
        {{--                justify-content: end;--}}
        {{--            }--}}
        {{--        </style>--}}
        {{--        <div class="time-selector">--}}
        {{--        <x-time-selector label='Time Selector' name="topSellingItemsPeriod" :topSellingItemsPeriod="$topSellingItemsPeriod"></x-time-selector>--}}
        {{--        </div>--}}

        <div class="dashboard-containers" id="reservation-activity-container">
            <h2>Reservations activity</h2>
            <hr>
            <div class="dashboard-container-content" id="reservation-activity-container-items">
                <div class="reservation-activity-container-item">
                    <h1 id="pending-res-h1">{{ $pendingReservations }}</h1>
                    <p><span class="material-symbols-outlined">pending</span>Pending reservations</p>
                </div>
                <div class="reservation-activity-container-item">
                    <h1 id="collected-res-h1">{{ $collectedReservations }}</h1>
                    <p><span class="material-symbols-outlined">check_circle</span>Collected reservations</p>
                </div>
            </div>
        </div>
        <div class="dashboard-containers" id="top-sellers-container">
            <h2>Top Selling</h2>
            <hr>
            <div class="flex-horizontal">
                @foreach($topSellingItems as $book)
                    <div>
                        <p>{{ $book->title }}</p>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="dashboard-containers" id="inventory-summary-container">
            <h2>Inventory summary</h2>
            <hr>
            <div class="dashboard-container-content" id="inventory-summary-container-items">
                <div class="inventory-summary-container-item">
                    <p>Books in stock: </p>
                    <hr>
                    <h2 id="in-stock-h2">{{ $booksInStockCount }}</h2>
                </div>
                <div class="inventory-summary-container-item">
                    <p>Books out of stock: </p>
                    <hr>
                    <h2 id="out-stock-h2">{{ $booksOutOfStockCount }}</h2>
                </div>
            </div>
        </div>
        <div class="dashboard-containers" id="purchase-sales-container">
            <div>
                <h2>Sales</h2>
                <div class="dashboard-container-content">
                    <p>Quantity sold: {{$quantitySold}}</p>
                    <p>Revenue: {{$totalRevenue}}</p>
                </div>
            </div>
            <div>
                <h2>Purchases</h2>
                <div class="dashboard-container-content">
                    <p>Quantity ordered: </p>
                    <p>Costs: </p>
                </div>
            </div>
        </div>
        <div class="dashboard-containers" id="chart">

        </div>
        {{--        create report and invoice button--}}

    </div>
</div>
</body>

</html>
