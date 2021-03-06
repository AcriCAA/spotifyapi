<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">



    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @include('layouts.partials.head')
</head>
<body class="@route_name">
    <div id="app">
        @include('layouts.partials.nav')
        <main class="main-wrapper">
            @include('layouts.partials.aside')
            @include('layouts.partials.main')
            @include('layouts.partials.success')
            @include('layouts.partials.fail')
            @yield('content')
            @include('layouts.partials.footer-scripts')
        </main>
    </div>
</body>
</html>
