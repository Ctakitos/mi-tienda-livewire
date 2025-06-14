<div class="container mt-4">
    <h3 class="mb-4">Gestión de Servicios</h3>

    @if (session()->has('message'))
        <div class="alert alert-success">{{ session('message') }}</div>
    @endif

    <form wire:submit.prevent="save" class="card p-4 shadow-sm mb-5">
        <div class="mb-3">
            <label for="name" class="form-label">Nombre del Servicio</label>
            <input type="text" wire:model.defer="name" id="name" class="form-control">
            @error('name') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Descripción</label>
            <textarea wire:model.defer="description" id="description" class="form-control" rows="3"></textarea>
            @error('description') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <div class="mb-3">
            <label for="price" class="form-label">Precio</label>
            <input type="number" wire:model.defer="price" id="price" class="form-control" step="0.01">
            @error('price') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <button type="submit" class="btn btn-success">Guardar Servicio</button>
    </form>

    <h5 class="mb-3">Servicios registrados</h5>
    <ul class="list-group">
        @forelse($services as $service)
            <li class="list-group-item d-flex justify-content-between align-items-center">
                {{ $service->name }}
                <span class="badge bg-primary rounded-pill">${{ number_format($service->price, 2) }}</span>
            </li>
        @empty
            <li class="list-group-item">No hay servicios registrados.</li>
        @endforelse
    </ul>
</div>

