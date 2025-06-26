<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
   public function up(): void
    {
        Schema::create('proyectos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre_proyecto');
            $table->string('cliente');
            $table->date('fecha_inicio');
            $table->string('tipo_documentacion'); // Planos, memorias, suelos, etc.
            $table->integer('duracion_dias');     // Cuántos días durará
            $table->date('fecha_estimada_entrega'); // Se calculará automáticamente
            $table->enum('estado', ['Recibido', 'En Proceso', 'En Corrección', 'Entregado'])->default('Recibido');
            $table->text('descripcion')->nullable(); // Información adicional
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('proyectos');
    }
};
