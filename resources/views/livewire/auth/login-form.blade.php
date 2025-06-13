<div class="max-w-md mx-auto bg-white p-6 rounded shadow mt-20">
    <h2 class="text-xl font-bold mb-4">Iniciar Sesión</h2>

    <form wire:submit.prevent="login" class="space-y-4">
        <div>
            <label class="block font-semibold">Correo:</label>
            <input type="email" wire:model="email" class="w-full border px-3 py-2 rounded" />
            @error('email') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
        </div>

        <div>
            <label class="block font-semibold">Contraseña:</label>
            <input type="password" wire:model="password" class="w-full border px-3 py-2 rounded" />
            @error('password') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
        </div>

        <button type="submit" class="w-full bg-indigo-600 text-white py-2 rounded hover:bg-indigo-700">
            Entrar
        </button>
    </form>
</div>






