<!doctype html>
<html lang="en">


<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="{{ asset('styles.css') }}?ts=<?=time()?>"/>
</head>

<body class="non-gradient-body">
    <x-header></x-header>
    <div class="top-selling-items-container">
        <style>
            .time-selector {
                display: flex;
                justify-content: end;
            }
        </style>
        <div class="time-selector">
        <x-time-selector label='Time Selector' name="topSellingItemsPeriod" :topSellingItemsPeriod="$topSellingItemsPeriod"></x-time-selector>
        </div>
        <div class="flex-horizontal">
            @foreach($topSellingItems as $book)
                <div>
                    <p>{{ $book->title }}</p>
                </div>
            @endforeach
        </div>
    </div>
    <div class="dashboard-container">
        <div class="recent-purchases"></div>
        <div class="revenue"></div>
        <div class="pie-chart"></div>
        <div class="line-graph"></div>
    </div>
    </body>
</html>
