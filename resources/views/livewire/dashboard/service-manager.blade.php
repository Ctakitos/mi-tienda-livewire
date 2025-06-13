<div class="p-4">
    @if (session()->has('message'))
        <div class="alert alert-success mb-3">{{ session('message') }}</div>
    @endif

    <form wire:submit.prevent="save" class="mb-4">
        <div class="mb-3">
            <label for="name" class="form-label">Nombre del servicio</label>
            <input type="text" wire:model="name" id="name" class="form-control">
            @error('name') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Descripción</label>
            <textarea wire:model="description" id="description" class="form-control"></textarea>
            @error('description') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <div class="mb-3">
            <label for="price" class="form-label">Precio</label>
            <input type="number" wire:model="price" id="price" class="form-control" step="0.01">
            @error('price') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <button type="submit" class="btn btn-primary">Guardar Servicio</button>
    </form>

    <hr>

    <h5>Servicios existentes</h5>
    <ul class="list-group">
        @foreach($services as $service)
            <li class="list-group-item">
                <strong>{{ $service->name }}</strong><br>
                <small>{{ $service->description }}</small><br>
                <small>Precio: ${{ $service->price }}</small>
            </li>
        @endforeach
    </ul>
</div>
