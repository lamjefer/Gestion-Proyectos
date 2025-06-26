<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFechaEntregaRealToProyectosTable extends Migration
{
    public function up()
    {
        Schema::table('proyectos', function (Blueprint $table) {
            $table->date('fecha_entrega_real')->nullable()->after('fecha_estimada_entrega');
        });
    }

    public function down()
    {
        Schema::table('proyectos', function (Blueprint $table) {
            $table->dropColumn('fecha_entrega_real');
        });
    }
}
