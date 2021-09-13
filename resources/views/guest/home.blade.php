<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">

        <!-- Favicon -->
        <link rel="shortcut icon" href="{{ asset('images/logo.png') }}" type="image/x-icon">

        <!-- Title -->
        <title>BoolBnb</title>
    </head>
    <body>
        <div id="root">
            
        </div>
        <script src="{{ asset('js/front.js') }}"></script>
    </body>
</html>