<div class="service-section py-4">
    <h2>Servicios</h2>
    <div class="row">
        @foreach ($services as $service)
            <div class="col-md-4 mb-3">
                <div class="card h-100">
                    <div class="card-body">
                        <h5 class="card-title">{{ $service->name }}</h5>
                        <p class="card-text">{{ $service->description }}</p>
                        @if ($service->price)
                            <p><strong>Precio:</strong> ${{ number_format($service->price, 2) }}</p>
                        @endif
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

