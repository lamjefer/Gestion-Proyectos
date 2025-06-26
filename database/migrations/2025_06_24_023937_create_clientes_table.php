<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('clientes', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('email')->nullable();
            $table->string('telefono')->nullable();
            $table->string('empresa')->nullable();
            $table->string('direccion')->nullable();
            $table->enum('estado', ['Activo', 'Inactivo'])->default('Activo');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('clientes');
    }
};

