<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>
    @section('style')
    <link href="{{ asset('css/static-page.css') }}" rel="stylesheet">
    @show
</head>
<body>
    @yield('content')
</body>
</html>
