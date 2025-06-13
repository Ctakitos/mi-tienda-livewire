<nav class="bg-gray-800 text-white px-6 py-4 rounded mb-6">
    <div class="flex items-center justify-between">
        <ul class="flex space-x-4">
            <li><a href="{{ route('home') }}" class="hover:underline">Home Frontend</a></li>
    
            @if ($user && $user->isAdmin())
                <li><a href="{{ route('dashboard.admin') }}" class="hover:underline">Dashboard Admin</a></li>
                <li><a href="{{ route('dashboard.banners') }}" class="hover:underline">Banners</a></li>
                <li><a href="{{ route('dashboard.products') }}" class="hover:underline">Productos</a></li>
                <li><a href="{{ route('dashboard.services') }}" class="hover:underline">Servicios</a></li>
                <li><a href="{{ route('dashboard.admin.about') }}" class="hover:underline">Servicios</a></li>
                <li><a href="{{ route('dashboard.admin.contact') }}" class="hover:underline">Servicios</a></li>
            @endif

        </ul>

        <div class="flex items-center space-x-4">
            <div class="text-sm text-gray-300">
                {{ $user->name ?? '' }} ({{ $user->role ?? '' }})
            </div>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="hover:underline text-blue-400">Cerrar Sesión</button>
            </form>
        </div>
    </div>
</nav>





