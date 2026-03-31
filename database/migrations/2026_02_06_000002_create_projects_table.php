<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('projects', function (Illuminate\Database\Schema\Blueprint $table) {
    $table->id();
    $table->string('title'); // Ex: "Liderança de Alta Performance"
    $table->text('description'); // Descrição do treinamento
    $table->string('category'); // Palestra, Workshop, Mentoria ou Consultoria
    $table->string('duration')->nullable(); // Ex: "08 horas" ou "16 horas"
    $table->string('image_path')->nullable(); // Para as fotos dos eventos
    $table->boolean('is_active')->default(true);
    $table->timestamps();
});

    }

    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
