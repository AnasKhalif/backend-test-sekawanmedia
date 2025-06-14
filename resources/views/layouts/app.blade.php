<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link rel="icon" type="image/png" href="{{ asset('assets/image/truk.png') }}">
    @vite('resources/css/app.css')
    @include('layouts.partials.link')
</head>

<body class="bg-gray-100">
    <div class="flex h-screen relative">
        <!-- Sidebar -->
        @include('layouts.partials.sidebar')

        <div class="flex-1 flex flex-col overflow-hidden">
            <!-- Header -->
            @include('layouts.partials.header')

            <!-- Main Content -->
            @yield('content')
        </div>
    </div>
    @yield('scripts')
</body>

</html>
