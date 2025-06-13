<div class="p-4 bg-white rounded shadow">
    @if (session()->has('message'))
        <div class="alert alert-success mb-3">{{ session('message') }}</div>
    @endif

    <h2 class="text-xl font-bold mb-4 capitalize">Editar sección: {{ $section }}</h2>

    <form wire:submit.prevent="save">
        <textarea wire:model.defer="content" class="form-control w-full h-40 p-2 border rounded" placeholder="Escribe el contenido..."></textarea>
        @error('content') 
            <span class="text-red-600 text-sm">{{ $message }}</span> 
        @enderror

        <button type="submit" class="btn btn-primary mt-3">Guardar</button>
    </form>
</div>
