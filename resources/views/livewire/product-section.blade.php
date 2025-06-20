<div>
    <!-- Sección de productos -->
    <section class="product-section">
        <div class="container">
            <div class="section-header text-center mb-4">
                <h2 class="section-title">Lo mas vendidos !😎</h2>
                <div class="section-underline"></div>
            </div>


            @if (session()->has('message'))
                <div class="alert alert-success text-center">{{ session('message') }}</div>
            @endif

            <div class="row g-4">
                @foreach ($products as $product)
                    <div class="col-12 col-sm-6 col-lg-4 d-flex">
    <div class="card product-card w-100 position-relative">
        
        {{-- Etiqueta "Más vendido" condicional --}}
        @if ($product->is_best_seller)
            <span class="badge-best-seller">🔥 Más vendido</span>
        @endif

        @if ($product->image)
            <div class="product-img-wrapper">
                <img src="{{ $product->image }}" class="product-img" alt="{{ $product->name }}">
            </div>
        @endif

        <div class="card-body d-flex flex-column">
            <h5 class="card-title">{{ $product->name }}</h5>
            <p class="card-text flex-grow-1">{{ Str::limit($product->description, 100) }}</p>

            @if ($product->price)
                <p class="price-tag">$ {{ number_format($product->price, 2) }}</p>
            @endif

            <div class="mt-auto d-flex justify-content-between">
                <button wire:click="selectProduct({{ $product->id }})"
                        class="btn btn-outline-primary btn-sm"
                        data-bs-toggle="modal"
                        data-bs-target="#productModal">
                    Ver detalles
                </button>
                <button wire:click="addToCart({{ $product->id }})"
                        class="btn btn-primary btn-sm">
                    Agregar al carrito
                </button>
            </div>
        </div>
    </div>
</div>

                @endforeach
            </div>

            <div class="d-flex justify-content-center mt-4">
                {{ $products->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </section>

    <!-- Modal de producto -->
    <div wire:ignore.self class="modal fade" id="productModal" tabindex="-1"
         aria-labelledby="productModalLabel" aria-hidden="true"
         data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                @if($selectedProduct)
                    <div class="modal-header">
                        <h5 class="modal-title" id="productModalLabel">{{ $selectedProduct->name }}</h5>
                        <button type="button" class="btn-close" wire:click="resetSelectedProduct" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                    </div>
                    <div class="modal-body">
                        @if ($selectedProduct->image)
                            <img src="{{ $selectedProduct->image }}" alt="{{ $selectedProduct->name }}" class="img-fluid mb-3">
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
        const productModal = document.getElementById('productModal');
        productModal.addEventListener('hidden.bs.modal', function () {
            Livewire.emit('resetSelectedProduct');
        });
    </script>
</div>





