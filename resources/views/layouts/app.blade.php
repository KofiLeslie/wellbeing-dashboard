<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="{{ asset('media/images/favicon.png') }}" type="image/png" />
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link href="{{ asset('media/css/bootstrap.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('media/css/bootstrap-extended.css') }}" rel="stylesheet" />
    <link href="{{ asset('media/css/style.css') }}" rel="stylesheet" />
    <link href="{{ asset('media/css/icons.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    @yield('headerlinks')
</head>

<body>
    @yield('content')
    <script src="{{ asset('media/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('media/js/jquery.min.js') }}"></script>
    @yield('footerlinks')
</body>

</html>
