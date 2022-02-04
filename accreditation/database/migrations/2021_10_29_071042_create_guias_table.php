<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGuiasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('guias', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('plantilla_id');
            $table->unsignedBigInteger('programa_educativo_id');
            $table->string('nombre_coordinador');
            $table->string('fecha_inicio');
            $table->string('status');
            $table->foreign('plantilla_id')
                      ->references('id')
                      ->on('plantillas')
                      ->onDelete('cascade');
            $table->foreign('programa_educativo_id')
                      ->references('id')
                      ->on('programa_educativo')
                      ->onDelete('cascade');
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
        Schema::dropIfExists('guias');
    }
}
