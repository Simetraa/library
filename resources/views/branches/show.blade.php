@php use App\Charts\Graph;use App\Models\Branch; @endphp
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
{{--         time selector--}}
{{--                <style>--}}
{{--                    .time-selector {--}}
{{--                        display: flex;--}}
{{--                        justify-content: end;--}}
{{--                    }--}}
{{--                </style>--}}
{{--         <div class="time-selector">--}}
{{--         <x-time-selector label='Time Selector' name="topSellingItemsPeriod" :topSellingItemsPeriod="$topSellingItemsPeriod"></x-time-selector>--}}
{{--    </div>--}}

        <div class="dashboard-containers" id="reservation-activity-container">
            <h2>Reservations activity</h2>
            <hr>
            <div class="dashboard-container-content" id="reservation-activity-container-items">
                <div class="reservation-activity-container-item">
                    <div class="res-number" id="pending-res-h1">{{ $pendingReservations }}</div>
                    <p><span class="material-symbols-outlined">hourglass_empty</span>Pending reservations</p>
                </div>
                <div class="reservation-activity-container-item">
                    <div class="res-number" id="collected-res-h1">{{ $collectedReservations }}</div>
                    <p><span class="material-symbols-outlined">check</span>Collected reservations</p>
                </div>
            </div>
        </div>
        <div class="dashboard-containers" id="top-sellers-container">
            <h2>Top Selling Books</h2>
            <hr>
            <div class="flex-horizontal" id="top-selling-items">
                @foreach($topSellingItems as $book)
                    <div class="top-selling-item">
                        <a href="/books/{{$book->id}}">
                            <img alt="cover-image" src="{{ $book->cover_url }}">
                            <p>{{ $book->title }}</p>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="dashboard-containers" id="inventory-summary-container">
            <h2>Inventory summary</h2>
            <hr>
            <div class="flex-horizontal">
                <div class="dashboard-container-content" id="inventory-summary-container-items">
                    <div class="inventory-summary-container-item">
                        Books in stock: <span class="prefix-dots" id="in-stock-h2">{{ $booksInStockCount }}</span>
                    </div>
                    <div class="inventory-summary-container-item">
                        Books out of stock: <span class="prefix-dots" id="out-stock-h2">{{ $booksOutOfStockCount }}</span>
                    </div>
                </div>
                <div>
                    {!! $pieChart->container() !!}
                    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js" charset="utf-8"></script>
                    {!! $pieChart->script() !!}
                </div>
            </div>
        </div>
        <div class="dashboard-containers" id="purchase-sales-container">
            <div>
                <h2 class="purchase-sale-header">Sales</h2>
                <div class="dashboard-container-content purchase-sale-data">
                    <div>
                        <p class="purchase-sale-number">{{$quantitySold}}</p>
                        <p>Quantity sold</p>
                    </div>
                    <div>
                        <p class="purchase-sale-number">£{{$totalRevenue}}</p>
                        <p>Revenue</p>
                    </div>
                </div>
            </div>
            <div>
                <h2 class="purchase-sale-header">Purchases</h2>
                <div class="dashboard-container-content purchase-sale-data">
                    <div>
                        <p class="purchase-sale-number">{{$quantityOrdered}}</p>
                        <p>Quantity ordered</p>
                    </div>
                    <div>
                        <p class="purchase-sale-number">£{{$totalCost}}</p>
                        <p>Costs</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="dashboard-containers" id="chart">
            <h2>Sales chart</h2>
            {!! $lineChart->container() !!}
            <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js" charset="utf-8"></script>
            {!! $lineChart->script() !!}
        </div>
        {{--        create report and invoice button--}}

    </div>
</div>
</body>

</html>
