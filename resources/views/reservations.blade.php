<!DOCTYPE html>
<html lang="en">
@php
    use App\Models\Branch;
@endphp

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catalogue</title>
    <link rel="stylesheet" href="{{ asset('styles.css') }}?ts=<?=time()?>"/>
    <link rel="stylesheet" href="{{ asset('mobile.css') }}?ts=<?=time()?>" media ="only screen and (max-width: 720px)"/>
</head>

<body class="non-gradient-body">
<x-header></x-header>
<div class="reservations-container">
    <h1>Reservations</h1>
    @php
        $user = Auth::user();
        $reservations = $user->reservations;
    @endphp

    @foreach($reservations as $reservation)
        <div class="reservation-card">
            <div class = "reserved-book-info">
                <div>
                    <h2>{{ $reservation->book->title }}</h2>
                    <p>Quantity: {{ $reservation->quantity }}</p>
                    <p>Branch: {{ $reservation->branch->name }}</p>
                    <p>Reservation date: {{$reservation->created_at}}</p>
                    <p>Pickup by: {{ $reservation->pickupDate }}</p>
                </div>


                <form method="POST" action="/reservations/{{ $reservation->id }}">
                    @csrf
                    @method('DELETE')
                    <button>Cancel reservation</button>
                </form>
            </div>

            <img src = '{{$reservation->book["cover_url"]}}' alt="book cover">
        </div>
    @endforeach
</div>
</body>
