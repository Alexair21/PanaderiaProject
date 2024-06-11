<!doctype html>
<html lang="{{ Config::get('app.locale') }}">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>

    <!-- CSS/JS files -->
    @if (config('tablar', 'vite'))
        @vite('resources/js/app.js')
    @endif
    {{-- Custom Stylesheets (post Tablar) --}}
    @yield('tablar_css')

    <style>
        body {
            background: url('/img/login.jpg') no-repeat center center fixed;
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            animation: slide 20s linear infinite;
        }
    </style>

</head>

<body class=" border-top-wide border-primary d-flex flex-column">
    <div class="page page-center">
        @yield('content')
    </div>
</body>

@yield('tablar_js')

</html>
