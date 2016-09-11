<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>{{ config('app.name') }} | @yield('title')</title>

        {{-- Styles --}}
        <link rel="stylesheet" type="text/css" href="{{ asset('css/app.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('css/plugins.css') }}">

        {{-- Extra styles --}}
        @yield('styles')

        {{-- Scripts --}}
        <script src="{{ asset('js/app.js') }}" type="text/javascript" charset="utf-8"></script>
        <script src="{{ asset('js/plugins.js') }}" type="text/javascript" charset="utf-8" async></script>

        {{-- Extra scripts --}}
        @yield('script-top')
    </head>
    @yield('body')
</html>
