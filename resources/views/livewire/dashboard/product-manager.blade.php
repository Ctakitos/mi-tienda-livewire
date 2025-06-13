<div class="p-4">
    @if (session()->has('message'))
        <div class="alert alert-success mb-3">
            {{ session('message') }}
        </div>
    @endif

    {{-- Formulario --}}
    <form wire:submit.prevent="save" enctype="multipart/form-data" class="mb-4">
        <h5 class="mb-3">{{ $selectedProduct ? 'Editar producto' : 'Crear nuevo producto' }}</h5>

        {{-- Nombre --}}
        <div class="mb-3">
            <label for="name">Nombre</label>
            <input type="text" wire:model.defer="name" id="name"
                class="form-control @error('name') is-invalid @enderror">
            @error('name') <span class="invalid-feedback">{{ $message }}</span> @enderror
        </div>

        {{-- Precio --}}
        <div class="mb-3">
            <label for="price">Precio</label>
            <input type="number" wire:model.defer="price" id="price" step="0.01"
                class="form-control @error('price') is-invalid @enderror">
            @error('price') <span class="invalid-feedback">{{ $message }}</span> @enderror
        </div>

        {{-- Descripción --}}
        <div class="mb-3">
            <label for="description">Descripción</label>
            <textarea wire:model.defer="description" id="description"
                class="form-control @error('description') is-invalid @enderror"></textarea>
            @error('description') <span class="invalid-feedback">{{ $message }}</span> @enderror
        </div>

        {{-- Tipo de imagen --}}
        <div class="mb-3">
            <label class="form-label">Tipo de imagen</label>
            <div class="form-check">
                <input class="form-check-input" type="radio" wire:model.live="imageInputType" value="upload"
                    id="imageUpload">
                <label class="form-check-label" for="imageUpload">Subir archivo</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" wire:model.live="imageInputType" value="url"
                    id="imageUrl">
                <label class="form-check-label" for="imageUrl">Usar URL externa</label>
            </div>
        </div>

        {{-- Imagen subida --}}
        @if ($imageInputType === 'upload')
            <div class="mb-3" wire:key="input-upload">
                <label for="image">Seleccionar imagen</label>
                <input type="file" wire:model="image" id="image"
                    class="form-control @error('image') is-invalid @enderror">
                @error('image') <span class="invalid-feedback">{{ $message }}</span> @enderror

                @if ($image)
                    <div class="mt-2">
                        <img src="{{ $image->temporaryUrl() }}" class="img-thumbnail" style="max-height: 150px;"
                            alt="Vista previa">
                    </div>
                @endif
            </div>
        @endif

        {{-- Imagen desde URL --}}
        @if ($imageInputType === 'url')
            <div class="mb-3" wire:key="input-url">
                <label for="image_url">URL de imagen</label>
                <input type="url" wire:model.defer="image_url" id="image_url"
                    class="form-control @error('image_url') is-invalid @enderror"
                    placeholder="https://example.com/imagen.jpg">
                @error('image_url') <span class="invalid-feedback">{{ $message }}</span> @enderror

                @if ($image_url)
                    <div class="mt-2">
                        <img src="{{ $image_url }}" class="img-thumbnail" style="max-height: 150px;"
                            alt="Vista previa desde URL">
                    </div>
                @endif
            </div>
        @endif

        {{-- Imagen actual --}}
        @if ($selectedProduct && $selectedProduct->image)
            <div class="mb-3">
                <label class="form-label">Imagen actual</label>
                <div>
                    <img src="{{ $selectedProduct->image }}" class="img-thumbnail" style="max-height: 150px;"
                        alt="Imagen actual">
                </div>
            </div>
        @endif

        {{-- Estado --}}
        <div class="form-check form-switch mb-3">
            <input type="checkbox" wire:model="is_active" class="form-check-input" id="is_active">
            <label class="form-check-label" for="is_active">Activo</label>
        </div>

        {{-- Botones --}}
        <button type="submit" class="btn btn-primary">
            {{ $selectedProduct ? 'Actualizar' : 'Guardar' }} Producto
        </button>
        @if ($selectedProduct)
            <button type="button" wire:click="resetInput" class="btn btn-secondary ms-2">Cancelar</button>
        @endif
    </form>

    <hr>

    {{-- Buscador --}}
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h5 class="mb-0">Productos existentes</h5>
        <input type="text" wire:model.debounce.300ms="search" class="form-control w-25"
            placeholder="Buscar por nombre o descripción...">
    </div>

    {{-- Tabla --}}
    <div class="table-responsive">
        <table class="table table-bordered align-middle">
            <thead class="table-light">
                <tr>
                    <th>Imagen</th>
                    <th>Nombre</th>
                    <th>Descripción</th>
                    <th>Precio</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($products as $product)
                    <tr>
                        <td style="width: 100px;">
                            @if ($product->image)
                                <img src="{{ $product->image }}" class="img-thumbnail" style="max-height: 80px;"
                                    alt="{{ $product->name }}">
                            @else
                                <span class="text-muted">Sin imagen</span>
                            @endif
                        </td>
                        <td>{{ $product->name }}</td>
                        <td>{{ \Illuminate\Support\Str::limit($product->description, 60) }}</td>
                        <td>${{ number_format($product->price, 2) }}</td>
                        <td>
                            <span class="badge bg-{{ $product->is_active ? 'success' : 'danger' }}">
                                {{ $product->is_active ? 'Activo' : 'Inactivo' }}
                            </span>
                        </td>
                        <td>
                            <button wire:click="editProduct({{ $product->id }})"
                                class="btn btn-sm btn-outline-secondary me-2">Editar</button>
                            <button wire:click="deleteProduct({{ $product->id }})"
                                onclick="confirm('¿Eliminar este producto?') || event.stopImmediatePropagation()"
                                class="btn btn-sm btn-outline-danger">Eliminar</button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center text-muted">No se encontraron productos.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Paginación --}}
    <div class="d-flex justify-content-center">
        {{ $products->links() }}
    </div>
</div>


