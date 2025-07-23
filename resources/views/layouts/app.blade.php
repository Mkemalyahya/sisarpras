<!DOCTYPE html>
<html lang="en">
    <head>
        @auth
    @if (Auth::user()->role !== 'admin')
        <script>
            window.location.href = "{{ route('login') }}";
        </script>
    @endif
@endauth
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>@yield('title')</title>

        <script src="https://cdn.tailwindcss.com"></script>
        <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
    </head>

    <body class="bg-white font-sans flex">
        @include('layouts.sidebar')

        <div class="ml-64 flex-1 overflow-hidden">
            @yield('content')
        </div>
    </body>
</html>
