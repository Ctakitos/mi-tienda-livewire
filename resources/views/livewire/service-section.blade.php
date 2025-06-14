<div>
    <div class="card my-5 shadow-sm">
        <div class="card-header bg-info text-white">
            <h4 class="mb-0">Nuestros Servicios</h4>
        </div>

        <div class="card-body">
            @if ($services->isEmpty())
                <p class="text-muted">No hay servicios disponibles por el momento.</p>
            @else
                <div class="row">
                    @foreach ($services as $service)
                        <div class="col-md-4 mb-4">
                            <div class="card h-100">
                                <div class="card-body d-flex flex-column">
                                    <h5 class="card-title">{{ $service->name }}</h5>
                                    <p class="card-text flex-grow-1">{{ Str::limit($service->description, 100) }}</p>
                                    @if ($service->price)
                                        <p class="mt-2 fw-bold text-success">$ {{ number_format($service->price, 2) }}</p>
                                    @endif
                                    <button class="btn btn-outline-info mt-auto" disabled>Solicitar</button>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</div>








