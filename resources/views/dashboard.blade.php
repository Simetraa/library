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
<div class="dashboard-container">
    <div class="recent-purchases"></div>
    <div class="revenue"></div>
    <div class="pie-chart"></div>
    <div class="line-graph"></div>
</div>
<p>{{ $topSellingItems }}</p>
<p>{{ $topSellingItemsTimeRange }}</p>
<x-time-selector label='Time Selector' name="topSellingItemsTimeRange"></x-time-selector>
</body>
</html>
