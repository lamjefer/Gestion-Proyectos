<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('proyectos', function (Blueprint $table) {
            $table->dropColumn('tipo_documentacion');
        });
    }

    public function down()
    {
        Schema::table('proyectos', function (Blueprint $table) {
            $table->string('tipo_documentacion')->nullable();
        });
    }
};



