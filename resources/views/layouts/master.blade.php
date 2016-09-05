<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>The Grapes - Wine &amp; Lounge | @yield('title')</title>

        {{-- Styles --}}
        <link rel="stylesheet" type="text/css" href="{{ asset('css/app.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('css/plugins.css') }}">

        {{-- Scripts --}}
        <script src="{{ asset('js/app.js') }}" type="text/javascript" charset="utf-8" defer></script>
        <script src="{{ asset('js/plugins.js') }}" type="text/javascript" charset="utf-8" defer></script>
    </head>
    @yield('body')
</html>
