<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buy Movie Tickets</title>
</head>
<body>
    <h3>Buy Movie Tickets KES 1500.00</h3>
    <form method="POST" action="{{ route('pay') }}" id="paymentForm">
        @csrf
        <input name="name" placeholder="Name" required />
        <input name="email" type="email" placeholder="Your Email" required />
        <input name="phone" type="tel" placeholder="Phone number" required />
        <input type="submit" value="Buy" />
    </form>
</body>
</html>
