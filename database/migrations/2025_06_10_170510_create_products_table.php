<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');                      // Nombre del producto
            $table->text('description')->nullable();     // Descripción opcional
            $table->decimal('price', 10, 2)->nullable(); // Precio
            $table->string('image_path')->nullable();    // Imagen subida localmente
            $table->string('image_url')->nullable();     // Imagen externa (URL)
            $table->boolean('is_active')->default(true); // Estado activo/inactivo
            $table->timestamps();                        // created_at / updated_at
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
