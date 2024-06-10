<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Failed</title>
</head>
<body>
    <h3>Payment Failed</h3>
    <p>Transaction ID: {{ $data['data']['id'] }}</p>
    <p>Amount: {{ $data['data']['amount'] }}</p>
    <p>Status: {{ $data['data']['status'] }}</p>
</body>
</html>
