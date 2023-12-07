<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    {{-- <meta http-equiv="X-UA-Compatible" content="ie=edge"/> --}}

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <style>
        @import url('https://rsms.me/inter/inter.css');
        :root {
            --tblr-font-sans-serif: 'Inter Var', -apple-system, BlinkMacSystemFont, San Francisco, Segoe UI, Roboto, Helvetica Neue, sans-serif;
        }
        body {
            font-feature-settings: "cv03", "cv04", "cv11";
        }
    </style>
    <!-- Scripts -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="{{ asset('font-awesome/css/font-awesome.min.css') }}">

    {{-- scadavis --}}
    <script src="{{ asset('scadavis/synopticapi.js') }}"></script>
    <script src="https://cdn.bootcdn.net/ajax/libs/socket.io/2.3.0/socket.io.js"></script>
    
    @vite(['resources/sass/app.scss', 'resources/js/app.js', 'resources/js/index.js'])
</head>
<body>
    
<div class="layout has-sidebar fixed-sidebar fixed-header" id="app">
    @include('layouts.partials.sidebar')
    <div id="overlay" class="overlay"></div>
    <div class="layout">
        @include('layouts.partials.headerdash')
        {{-- @include('layouts.partials.content') --}}
        <a id="btn-toggle" href="#" class="sidebar-toggler break-point-lg">
            <i class="ri-menu-line ri-xl"></i>
        </a>
        @yield('content')
        <div class="overlay"></div>
        @include('layouts.partials.footer')
    </div>
</div>
@yield('js')
</body>
</html>
