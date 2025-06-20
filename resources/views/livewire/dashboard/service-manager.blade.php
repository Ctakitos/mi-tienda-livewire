<div class="container mt-4">
    @if (session()->has('message'))
        <div class="alert alert-success">{{ session('message') }}</div>
    @endif


    <form wire:submit.prevent="save" enctype="multipart/form-data" class="card p-4 shadow-sm mb-5">
        <h5 class="mb-3">{{ $selectedService ? 'Editar Servicio' : 'Nuevo Servicio' }}</h5>

        <div class="mb-3">
            <label>Nombre</label>
            <input type="text" wire:model.defer="name" class="form-control">
            @error('name') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="mb-3">
            <label>Descripción</label>
            <textarea wire:model.defer="description" class="form-control"></textarea>
            @error('description') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="mb-3">
            <label>Precio</label>
            <input type="number" wire:model.defer="price" step="0.01" class="form-control">
            @error('price') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        {{-- Tipo de imagen --}}
        <div class="form-check">
            <input class="form-check-input" type="radio" wire:model.live="imageInputType" value="upload" id="imageUpload">
            <label class="form-check-label" for="imageUpload">Subir archivo</label>
            </div>
        <div class="form-check">
            <input class="form-check-input" type="radio" wire:model.live="imageInputType" value="url" id="imageUrl">
            <label class="form-check-label" for="imageUrl">Usar URL externa</label>
        </div>

        {{-- Imagen subida --}}
        @if ($imageInputType === 'upload')
            <div class="mb-3" wire:key="input-upload">
                <label>Seleccionar imagen</label>
                <input type="file" wire:model="image" class="form-control">
                @error('image') <small class="text-danger">{{ $message }}</small> @enderror
                @if ($image)
                    <img src="{{ $image->temporaryUrl() }}" class="img-thumbnail mt-2" style="max-height: 150px;" alt="Vista previa">
                @elseif($selectedService && $selectedService->image_path)
                    <img src="{{ asset('storage/'.$selectedService->image_path) }}" class="img-thumbnail mt-2" style="max-height: 150px;" alt="Imagen actual">
                @endif
            </div>
        @endif

        {{-- Imagen desde URL --}}
        @if ($imageInputType === 'url')
            <div class="mb-3" wire:key="input-url">
                <label>URL de imagen</label>
                <input type="url" wire:model="image_url" class="form-control" placeholder="https://example.com/imagen.jpg">
                @error('image_url') <small class="text-danger">{{ $message }}</small> @enderror
                @if ($image_url)
                    <img src="{{ $image_url }}" class="img-thumbnail mt-2" style="max-height: 150px;" alt="Vista previa URL">
                @elseif($selectedService && $selectedService->image_url)
                    <img src="{{ $selectedService->image_url }}" class="img-thumbnail mt-2" style="max-height: 150px;" alt="Imagen actual URL">
                @endif
            </div>
        @endif

        <div class="form-check form-switch mb-3">
            <input class="form-check-input" type="checkbox" wire:model="is_active" id="is_active">
            <label class="form-check-label" for="is_active">Activo</label>
        </div>

        <button class="btn btn-success" type="submit">
            {{ $selectedService ? 'Actualizar Servicio' : 'Guardar Servicio' }}
        </button>
        @if ($selectedService)
            <button type="button" wire:click="resetInput" class="btn btn-secondary ms-2">Cancelar</button>
        @endif
    </form>


    <h5 class="mb-3">Servicios registrados</h5>

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
            @forelse ($services as $service)
                <tr>
                    <td style="width: 100px;">
                        @if ($service->image_path)
                            <img src="{{ asset('storage/' . $service->image_path) }}" class="img-thumbnail" style="max-height: 80px;" alt="Imagen">
                        @elseif($service->image_url)
                            <img src="{{ $service->image_url }}" class="img-thumbnail" style="max-height: 80px;" alt="Imagen URL">
                        @else
                            <span class="text-muted">Sin imagen</span>
                        @endif
                    </td>
                    <td>{{ $service->name }}</td>
                    <td>{{ \Illuminate\Support\Str::limit($service->description, 60) }}</td>
                    <td>
                        @if ($service->price !== null)
                            ${{ number_format($service->price, 2) }}
                        @else
                            <span class="text-muted">N/A</span>
                        @endif
                    </td>
                    <td>
                        <span class="badge bg-{{ $service->is_active ? 'success' : 'danger' }}">
                            {{ $service->is_active ? 'Activo' : 'Inactivo' }}
                        </span>
                    </td>
                    <td>
                        <button wire:click="edit({{ $service->id }})"
                            class="btn btn-sm btn-outline-secondary me-2">Editar</button>
                        <button wire:click="delete({{ $service->id }})"
                            onclick="confirm('¿Eliminar este servicio?') || event.stopImmediatePropagation()"
                            class="btn btn-sm btn-outline-danger">Eliminar</button>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center text-muted">No hay servicios registrados.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
<div class="d-flex justify-content-center mt-3">
    {{ $services->links() }}
</div>

</div>





