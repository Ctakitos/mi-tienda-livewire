<div class="p-6 bg-white shadow rounded">
        <h2 class="text-xl font-semibold mb-4">Editar sección "Contacto"</h2>

        @if (session()->has('message'))
            <div class="text-green-600 mb-2">{{ session('message') }}</div>
        @endif

        <form wire:submit.prevent="save">
            <textarea wire:model.defer="content" rows="10" class="w-full border rounded p-2"></textarea>
            <button type="submit" class="mt-2 px-4 py-2 bg-blue-600 text-white rounded">Guardar</button>
        </form>
</div>

