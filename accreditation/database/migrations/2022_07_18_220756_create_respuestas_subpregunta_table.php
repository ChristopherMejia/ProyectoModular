<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRespuestasSubpreguntaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('respuestas_subpregunta', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('cuestionario_id');
            $table->unsignedBigInteger('subpregunta_id');
            $table->string('respuesta')->nullable();
            $table->string('evidencia')->nullable();
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
        Schema::dropIfExists('respuestas_subpregunta');
    }
}
