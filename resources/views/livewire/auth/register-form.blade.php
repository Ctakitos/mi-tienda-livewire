<div class="max-w-md mx-auto bg-white dark:bg-gray-800 p-8 rounded-xl shadow-lg mt-20">
    <h2 class="text-2xl font-bold text-center text-gray-800 dark:text-white mb-6">Crear Cuenta</h2>

    <form wire:submit.prevent="register" class="space-y-5">
        <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-200">Nombre</label>
            <input type="text" wire:model="name" placeholder="Tu nombre completo"
                   class="w-full mt-1 px-4 py-2 border rounded-md focus:ring-2 focus:ring-indigo-500 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:text-white" />
            @error('name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-200">Correo</label>
            <input type="email" wire:model="email" placeholder="tucorreo@ejemplo.com"
                   class="w-full mt-1 px-4 py-2 border rounded-md focus:ring-2 focus:ring-indigo-500 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:text-white" />
            @error('email') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-200">Contraseña</label>
            <input type="password" wire:model="password" placeholder="••••••••"
                   class="w-full mt-1 px-4 py-2 border rounded-md focus:ring-2 focus:ring-indigo-500 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:text-white" />
            @error('password') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-200">Confirmar Contraseña</label>
            <input type="password" wire:model="password_confirmation" placeholder="••••••••"
                   class="w-full mt-1 px-4 py-2 border rounded-md focus:ring-2 focus:ring-indigo-500 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:text-white" />
        </div>

        <button type="submit"
                class="w-full bg-indigo-600 hover:bg-indigo-700 text-white py-2 rounded-md transition shadow-md">
            Registrarse
        </button>

        <p class="text-sm text-center text-gray-600 dark:text-gray-300 mt-4">
            ¿Ya tienes una cuenta?
            <a href="{{ route('login') }}" class="text-indigo-600 hover:underline">Iniciar sesión</a>
        </p>
    </form>
</div>






