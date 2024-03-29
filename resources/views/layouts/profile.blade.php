<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'First Laravel Page')</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
</head>
<body>
<div id="app" class="row p-0 m-0 w-100 min-vh-100 secondary-color">
    <!-- Sidebar -->
    <div class="col-2 p-0">
        @yield('sidebar')
    </div>

    <div class="col p-0">
        @include('includes.header')
        <main class="py-4 container min-vh-100">
            @yield('content')
        </main>
        @include('includes.footer')
    </div>
</div>
</body>
</html>
