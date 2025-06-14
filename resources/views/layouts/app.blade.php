<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
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
    @include('layouts.partials.script')
</body>

</html>
