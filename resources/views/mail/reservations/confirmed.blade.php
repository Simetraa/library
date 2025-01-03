<!DOCTYPE html>



<html>
    <head>
        <style>
            body {
                background-color: rgb(131 116 217 / 80%);
                font-family: "Arial", sans-serif;
            }

            h1 {
                text-align: center;
            }

            .book-info {
                background-color: #ffffffc4;
                border-radius: 10px;
                padding: 25px;
                margin: 10px;
                box-shadow: 4px 4px 2px 2px rgb(0 0 0 / 10%);
            }

            a {
                background-color: #4b3f72;
                color: white;
                padding: 10px;
                border-radius: 10px;
                text-decoration: none;
                margin-top: 30px;
                text-align: center;
            }

            a:hover {
                background-color: #382b5e;
            }

            a:hover, a:visited {
                text-decoration: none;
            }

            p , h2{
                padding: 0 10px;
            }

            h3 {
                color: #4b3f72;
            }

        </style>
        <title>Reservation Confirmation</title>
    </head>
    <body>
        <h1>ATLAS</h1>
        <h2>Reservation Confirmation</h2>

        <p>Your reservation has been received! Please pick up your book within 7 days.</p>

        <div class="book-info">
            <h3>{{ $reservation->book->title }}</h3>
            <p>Author: {{ $reservation->book->author }}</p>
            <p>Branch: {{ $reservation->branch->name }}</p>
            <p>Pickup by: {{ $reservation->pickupDate->format("d-m-Y") }}</p>
            <p>Quantity: {{ $reservation->quantity }}</p>
            <br>
            <a href="http://library.test/account/reservations">View all reservations</a>
        </div>

        <p>Thanks,<br>ATLAS</p>

    </body>
</html>
