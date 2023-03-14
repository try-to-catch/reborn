<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ env('APP_NAME') }}</title>
    @vite('resources/js/app.js')
</head>
<body class="h-screen">
@yield('content')
<style>
    ::-webkit-scrollbar {
        width: 7px;
        background-color: #2b2d32;
        border-radius: 10px;
    }

    ::-webkit-scrollbar-thumb {
        background-color: #222427;
        border-radius: 10px;
    }
</style>
</body>

</html>
