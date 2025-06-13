<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Panel Admin')</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @livewireStyles
</head>
<body class="@yield('bodyClass', 'bg-light')">

    <main class="py-6 container">
        @yield('content')
    </main>

    @livewireScripts
</body>
</html>
