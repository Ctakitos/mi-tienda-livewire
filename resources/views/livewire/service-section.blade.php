<div>
    <div class="container py-5">
    <h2 class="mb-4">Nuestros Servicios</h2>

    <div class="row">
        @forelse ($services as $service)
            <div class="col-md-4 mb-4">
                <div class="card h-100 shadow-sm">
                    @if ($service->image)
                        <img src="{{ $service->image }}" class="card-img-top" alt="{{ $service->name }}" style="max-height: 200px; object-fit: cover;">
                    @endif

                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">{{ $service->name }}</h5>
                        <p class="card-text">{{ Str::limit($service->description, 100) }}</p>

                        @if ($service->price !== null)
                            <p class="fw-bold text-success mt-auto">${{ number_format($service->price, 2) }}</p>
                        @endif

                        <a href="#" class="btn btn-primary mt-3">
                            Solicitar servicio
                        </a>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 text-center text-muted">
                <p>No hay servicios disponibles en este momento.</p>
            </div>
        @endforelse
    </div>
</div>

</div>