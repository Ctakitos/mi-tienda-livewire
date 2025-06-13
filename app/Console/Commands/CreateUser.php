<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class CreateUser extends Command
{
    protected $signature = 'app:create-user 
                            {--name= : Nombre del usuario}
                            {--email= : Email del usuario}
                            {--password= : Contraseña}
                            {--role=user : Rol del usuario (admin o user)}';

    protected $description = 'Crea un nuevo usuario manualmente desde consola';

    public function handle()
    {
        $name = $this->option('name') ?? $this->ask('Nombre del usuario');
        $email = $this->option('email') ?? $this->ask('Email');
        $password = $this->option('password') ?? $this->secret('Contraseña');
        $role = $this->option('role');

        if (!in_array($role, ['user', 'admin'])) {
            $this->error('Rol inválido. Usa "user" o "admin".');
            return 1;
        }

        if (User::where('email', $email)->exists()) {
            $this->error('Ya existe un usuario con ese email.');
            return 1;
        }

        User::create([
            'name' => $name,
            'email' => $email,
            'password' => Hash::make($password),
            'role' => $role,
        ]);

        $this->info("Usuario {$name} creado correctamente con rol '{$role}'.");
        return 0;
    }
}
