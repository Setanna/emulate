<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
        @vite('resources/css/app.css')
        @vite('resources/js/app.js')
        <script>
            window.Laravel = {!! json_encode([
                    'user' => Auth::user(),
                ]) !!};
        </script>

        <title>Emulate</title>

    </head>
    <body>
        <!-- App -->
        <div id="app"></div>
    </body>
</html>
