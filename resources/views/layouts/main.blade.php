<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}"/>

    <title>TaskWatch</title>
    @include('layouts.resource-loading.css')
</head>
<body class="d-flex flex-column min-vh-100">
@include('layouts.header')
<main role="main" class="container">
        @yield('content')
</main>
@include('layouts.footer')

@guest
@include('layouts.modals.login')
@endguest
@include('layouts.resource-loading.js')

@yield('after-scripts')
</body>
</html>
