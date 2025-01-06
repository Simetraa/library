@php use App\Models\Book; @endphp
    <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservations</title>
    <link rel="stylesheet" href="{{ asset('styles.css') }}"/>
</head>

<body class="non-gradient-body">
<x-header></x-header>

<div class="sidebar-body">
    {{-- side bar --}}
    <x-dashboard-sidebar :branch="$branch"></x-dashboard-sidebar>
    <div class="branch-tables">
        <h1>{{$branch->name}} - Reservations</h1>
        <div  class = "inventory-inputs">
            <form action="/branches/{{ $branch->id }}/reservations">
                <input type="text" placeholder="Reservation ID" name="reservation-id" value="{{request('reservation-id')}}">
                <input type="text" placeholder="User ID" name="user-id" value="{{request('user-id')}}">
                <input type="text" placeholder="Email" name="email" value="{{request('email')}}">
                <label for="collected">Only collected</label><input type="checkbox" name="collected" {{request('collected') ? 'checked' : ''}}>
                <x-dropdown id="dropdown"
                            name="sort-by"
                            :value="request('sort-by')"
                            :options="
[
        ['Time: Old - New', 'time-old-new'],
        ['Time: New - Old', 'time-new-old']
]"></x-dropdown>
                <button type="submit">Search</button>
            </form>
        </div>
        <table class="inventory-table">
            <thead>
                <tr>
                    <th scope="col">Reservation ID</th>
                    <th scope="col">User ID</th>
                    <th scope="col">Email</th>
                    <th scope="col">Title</th>
                    <th scope="col">Author</th>
                    <th scope="col">Quantity</th>
                    <th scope="col">Branch Stock</th>
                    <th scope="col">Status</th>
                    <th scope="col">Fulfil</th>
                </tr>
            </thead>
            <tbody>
            @foreach($reservations as $reservation)
                @php
                    // check if branch stock level < reservation quantity
                    // TODO: We have to put a check here.
                    // $branch->books->first()->pivot->quantity
                    $branchStock = $branch->books->find($reservation->book->id)->pivot->quantity;
                    $reservationQuantity = $reservation->quantity;

                    $isStockAvailable = $branchStock >= $reservationQuantity;
                    $collected = $reservation->status === "collected";
                    $canCollect = $isStockAvailable && !$collected;
                @endphp
                <tr>
                    <td>{{ $reservation->id }}</td>
                    <td>{{ $reservation->user->id }}</td>
                    <td>{{ $reservation->user->email }}</td>
                    <td>{{ $reservation->book->title }}</td>
                    <td>{{ $reservation->book->author }}</td>
                    <td>{{ $reservation->quantity }}</td>
                    <td>{{ $branchStock }}</td>
                    <td>{{ $reservation->status }}</td>
                    <td>

                        <form action="/reservations/{{$reservation->id}}" method="POST">
                            @csrf
                            <button type="submit" {{$canCollect ? "" : "disabled"}}>Fulfil</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        {{ $reservations->appends(request()->all())->links('pagination::simple-default') }}

    </div>
</div>
</body>

</html>
