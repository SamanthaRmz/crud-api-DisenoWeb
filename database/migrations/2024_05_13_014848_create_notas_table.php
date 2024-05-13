<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('notas', function (Blueprint $table) {
            $table->id();
            $table->string('titulo');
            $table->string('autor');
            $table->text('cuerpo'); 
            $table->string('clasificacion'); 
            $table->timestamps(); //Fecha y hora de creación y actualización
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('notas');
    }
};
