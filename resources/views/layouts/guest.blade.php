<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">

        <!-- Scripts -->
        <script src="https://kit.fontawesome.com/6a440e0993.js" crossorigin="anonymous"></script>

        @include('layouts.alerts')
    </head>
    <body>
        <div id="app" class="h-screen flex flex-col ">
            <x-header />
            <div class="h-full font-sans text-gray-900 antialiased mt-28 flex flex-col">
                {{ $slot }}
            </div>
            <alert />
        </div>
    <script src="{{ mix('js/app.js') }}"></script>
    </body>
</html>
