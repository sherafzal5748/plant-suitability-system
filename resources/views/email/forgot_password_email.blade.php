<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Email</title>
</head>
<body>
    {{-- sending 4-digit code to user for password reset"forgot password" --}}

    <h1>{{  $subject }}</h1>
    <p>{{ $mailmessage }}</p>
    <p>{{ $fourDigitNumber }}</p>

</body>
</html>