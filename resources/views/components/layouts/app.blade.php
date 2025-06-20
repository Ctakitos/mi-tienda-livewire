<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <script>
        (function () {
            try {
                const theme = localStorage.getItem('theme');
                const systemPrefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
                const shouldUseDark = theme === 'dark' || (!theme && systemPrefersDark);
                if (shouldUseDark) {
                    document.documentElement.classList.add('dark-mode');
                }
            } catch (e) {
                // En caso de error, no hacemos nada
            }
        })();
    </script>

    <title>@yield('title', 'Panel Admin')</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">       
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    
    @livewireStyles
    @vite(['resources/css/app.css', 'resources/js/app.js'])


</head>
<body class="@yield('bodyClass', 'bg-peligro')">

    <main class="py-6 container">
        @yield('content')
    </main>

    @livewireScripts

</body>
</html>








