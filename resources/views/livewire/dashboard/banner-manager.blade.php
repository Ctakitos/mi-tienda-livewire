<div class="p-4">

    @if (session()->has('message'))
        <div class="alert alert-success mb-3">{{ session('message') }}</div>
    @endif

    <form wire:submit.prevent="save" enctype="multipart/form-data" class="mb-4">
        <h5 class="mb-3">{{ $selectedBannerId ? 'Editar banner' : 'Crear nuevo banner' }}</h5>

        <div class="mb-3">
            <label for="title">Título</label>
            <input type="text" wire:model.defer="title" id="title" class="form-control @error('title') is-invalid @enderror">
            @error('title') <span class="invalid-feedback">{{ $message }}</span> @enderror
        </div>

        <div class="mb-3">
            <label for="description">Descripción</label>
            <textarea wire:model.defer="description" id="description" class="form-control @error('description') is-invalid @enderror"></textarea>
            @error('description') <span class="invalid-feedback">{{ $message }}</span> @enderror
        </div>

       {{-- Selector de tipo de imagen --}}
            <div class="mb-3">
                <label class="form-label">Selecciona el tipo de imagen</label>
                <div class="form-check">
                    <input class="form-check-input" type="radio" wire:model.live="imageInputType" value="upload" id="imageUpload">
                    <label class="form-check-label" for="imageUpload">
                        Subir archivo
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" wire:model.live="imageInputType" value="url" id="imageUrl">
                    <label class="form-check-label" for="imageUrl">
                        Usar URL externa
                    </label>
                </div>
            </div>

            {{-- Campo de carga de archivo --}}
            @if ($imageInputType === 'upload')
                <div class="mb-3">
                    <label for="image">Subir imagen</label>
                    <input type="file" wire:model="image" id="image" class="form-control @error('image') is-invalid @enderror">
                    @error('image') <span class="invalid-feedback">{{ $message }}</span> @enderror
                </div>
            @endif

            {{-- Campo de URL externa --}}
            @if ($imageInputType === 'url')
                <div class="mb-3">
                    <label for="image_url">URL de la imagen</label>
                    <input type="url" wire:model.defer="image_url" id="image_url" placeholder="https://example.com/imagen.jpg" class="form-control @error('image_url') is-invalid @enderror">
                    @error('image_url') <span class="invalid-feedback">{{ $message }}</span> @enderror
                </div>
            @endif


            <div class="mt-3">
                <button type="submit" class="btn btn-primary">
                    {{ $selectedBannerId ? 'Actualizar' : 'Guardar' }} Banner
                </button>

                @if ($selectedBannerId)
                    <button type="button" wire:click="cancelEdit" class="btn btn-secondary ms-2">Cancelar</button>
                @endif
            </div>
    </form>

    <hr>

    <div class="d-flex justify-content-between align-items-center mb-2">
        <h5 class="mb-0">Banners existentes </h5>
         <input type="text" wire:model.debounce.300ms="search" class="form-control w-25" placeholder="Buscar...">
    </div>

    <div class="alert alert-info">
        Activos: {{ $banners->where('is_active', true)->count() }} / 5 permitidos
    </div>

    <div class="table-responsive">
        <table class="table table-bordered align-middle">
            <thead class="table-light">
                <tr>
                    <th>Imagen</th>
                    <th>Título</th>
                    <th>Descripción</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($banners as $banner)
                    <tr>
                        <td>
                            @if ($banner->image_url)
                                <img src="{{ $banner->image_url }}" width="100" alt="Imagen externa">
                            @elseif ($banner->image_path)
                                <img src="{{ asset('storage/' . $banner->image_path) }}" width="100" alt="Imagen local">
                            @else
                                <span class="text-muted">Sin imagen</span>
                            @endif
                        </td>
                        <td>{{ $banner->title }}</td>
                        <td>{{ $banner->description }}</td>
                        <td>
                            <span class="badge bg-{{ $banner->is_active ? 'success' : 'secondary' }}">
                                {{ $banner->is_active ? 'Activo' : 'Inactivo' }}
                            </span>
                        </td>
                        <td>
                            <button wire:click="edit({{ $banner->id }})" class="btn btn-sm btn-outline-secondary me-2">
                                Editar
                            </button>

                            <button 
                                wire:click="toggleStatus({{ $banner->id }})" 
                                class="btn btn-sm btn-outline-primary me-2"
                                @if(!$banner->is_active && $banners->where('is_active', true)->count() >= 5) disabled @endif
                            >
                                {{ $banner->is_active ? 'Desactivar' : 'Activar' }}
                            </button>

                            <button 
                                wire:click="delete({{ $banner->id }})"
                                onclick="confirm('¿Eliminar este banner?') || event.stopImmediatePropagation()"
                                class="btn btn-sm btn-outline-danger">
                                Eliminar
                            </button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center">No se encontraron banners.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="d-flex justify-content-center">
        {{ $banners->links() }}
    </div>
</div>