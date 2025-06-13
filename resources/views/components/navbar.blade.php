<nav class="bg-gray-800 text-white px-6 py-4 rounded">
    <ul class="flex space-x-4">
        <li><a href="{{ route('home') }}" class="hover:underline">Inicio</a></li>
        <li><a href="{{ route('dashboard.banners') }}" class="hover:underline">Banners</a></li>
        <li><a href="{{ route('dashboard.banners') }}" class="hover:underline">Productos</a></li>
        <li><a href="{{ route('dashboard.banners') }}" class="hover:underline">Servicios</a></li>
        <li><a href="{{ route('dashboard.banners') }}" class="hover:underline">Nosotros</a></li>
        <li><a href="{{ route('dashboard.banners') }}" class="hover:underline">Contacto</a></li>
    </ul>

    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit" class="hover:underline">Cerrar Sesión</button>
    </form>

</nav>


