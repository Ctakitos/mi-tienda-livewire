<div>
    <h2 class="mb-4">Productos</h2>

    @if (session()->has('message'))
        <div class="alert alert-success">{{ session('message') }}</div>
    @endif

    <div class="row">
        @foreach ($products as $product)
            <div class="col-md-4 mb-4">
                <div class="card h-100 product-card">
                    @if ($product->image)
                        <img src="{{ asset('storage/' . $product->image) }}" class="card-img-top" alt="{{ $product->name }}">
                    @endif
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">{{ $product->name }}</h5>
                        <p class="card-text flex-grow-1">{{ Str::limit($product->description, 100) }}</p>
                        @if ($product->price)
                            <p class="price-tag mt-2 text-primary fw-bold">$ {{ number_format($product->price, 2) }}</p>
                        @endif
                        <div class="mt-auto d-flex justify-content-between">
                            <button wire:click="selectProduct({{ $product->id }})" class="btn btn-outline-primary btn-sm" data-bs-toggle="modal" data-bs-target="#productModal">Ver detalles</button>
                            <button wire:click="addToCart({{ $product->id }})" class="btn btn-primary btn-sm">Agregar al carrito</button>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <div class="d-flex justify-content-center">
        {{ $products->links('pagination::bootstrap-5') }}
    </div>

    <!-- Modal -->
    <div wire:ignore.self class="modal fade" id="productModal" tabindex="-1" aria-labelledby="productModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                @if($selectedProduct)
                    <div class="modal-header">
                        <h5 class="modal-title" id="productModalLabel">{{ $selectedProduct->name }}</h5>
                        <button type="button" class="btn-close" wire:click="resetSelectedProduct" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        @if ($selectedProduct->image)
                            <img src="{{ asset('storage/' . $selectedProduct->image) }}" alt="{{ $selectedProduct->name }}" class="img-fluid mb-3">
                        @endif
                        <p>{{ $selectedProduct->description }}</p>
                        @if ($selectedProduct->price)
                            <p class="fw-bold">Precio: $ {{ number_format($selectedProduct->price, 2) }}</p>
                        @endif
                    </div>
                    <div class="modal-footer">
                        <button wire:click="addToCart({{ $selectedProduct->id }})" class="btn btn-primary">Agregar al carrito</button>
                        <button type="button" class="btn btn-secondary" wire:click="resetSelectedProduct" data-bs-dismiss="modal">Cerrar</button>
                    </div>
                @else
                    <div class="modal-body">
                        <p>Cargando...</p>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <script>
        // Escuchar eventos Livewire para cerrar modal y resetear selección
        Livewire.on('productSelected', () => {
            var myModal = new bootstrap.Modal(document.getElementById('productModal'));
            myModal.show();
        });

        // Al cerrar modal limpiar selección
        var productModal = document.getElementById('productModal');
        productModal.addEventListener('hidden.bs.modal', function () {
            Livewire.emit('resetSelectedProduct');
        });
    </script>
</div>
