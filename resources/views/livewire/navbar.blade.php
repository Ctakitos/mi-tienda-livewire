<div>
    <nav id="mainNavbar" class="navbar navbar-expand-lg navbar-dark bg-transparent fixed-top px-4 py-3">
        <div class="container-fluid">

            {{-- Logo --}}
            <a class="navbar-brand brand-logo" href="{{ route('home') }}">Millennials</a>

            {{-- Botón hamburguesa --}}
            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent">
                <span class="navbar-toggler-icon"></span>
            </button>

            {{-- Contenido de navegación --}}
            <div class="collapse navbar-collapse" id="navbarContent">
                <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
                    {{-- Enlaces visibles para todos --}}
                    <li class="nav-item"><a class="nav-link nav-hover gray-900" href="{{ route('home') }}">Inicio</a></li>
                    <li class="nav-item"><a class="nav-link nav-hover gray-900" href="#">Servicios</a></li>
                    <li class="nav-item"><a class="nav-link nav-hover gray-900" href="#">Nosotros</a></li>
                    <li class="nav-item"><a class="nav-link nav-hover gray-900" href="#">Contacto</a></li>

                    {{-- Enlaces condicionales según el rol --}}
                    @auth
                        @if(auth()->user()->isAdmin())
                            <li class="nav-item">
                                <a class="nav-link nav-hover gray-900" href="{{ route('dashboard.admin') }}">
                                    <i class="bi bi-speedometer2 me-1"></i> Admin Panel
                                </a>
                            </li>
                        @elseif(auth()->user()->isUser())
                            <li class="nav-item">
                                <a class="nav-link nav-hover gray-900" href="#">
                                    <i class="bi bi-person-circle me-1"></i> Mi Perfil
                                </a>
                            </li>
                        @endif

                        {{-- Cerrar sesión --}}
                        <li class="nav-item">
                            <a class="nav-link nav-hover text-danger" href="#" wire:click.prevent="logout">
                                <i class="bi bi-box-arrow-right me-1"></i> Cerrar sesión
                            </a>
                        </li>
                    @else
                        {{-- Usuario no autenticado --}}
                        <li class="nav-item">
                            <a class="nav-link nav-hover gray-900" href="{{ route('login') }}">
                                <i class="bi bi-box-arrow-in-right me-1"></i> Iniciar sesión
                            </a>
                        </li>
                    @endauth
                </ul>

                {{-- Iconos de redes sociales y botón de tema --}}
                <div class="d-flex align-items-center gap-3">
                    <a href="https://facebook.com" target="_blank" class="icon-link facebook">
                        <i class="bi bi-facebook fs-5"></i>
                    </a>
                    <a href="https://instagram.com" target="_blank" class="icon-link instagram">
                        <i class="bi bi-instagram fs-5"></i>
                    </a>
                    <a href="https://wa.me/123456789" target="_blank" class="icon-link whatsapp">
                        <i class="bi bi-whatsapp fs-5"></i>
                    </a>

                    {{-- Botón de modo oscuro --}}
                    <button id="toggleTheme" class="icon-link theme-toggle-btn" title="Cambiar tema">
                        <i id="themeIcon" class="bi bi-moon-fill"></i>
                    </button>
                </div>
            </div>
        </div>
    </nav>
</div>






























