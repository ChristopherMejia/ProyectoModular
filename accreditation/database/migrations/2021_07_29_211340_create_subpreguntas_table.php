<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubpreguntasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subpreguntas', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->unsignedBigInteger('idTipo');
                $table->string('descripcion');
                $table->unsignedBigInteger('idPregunta');
                $table->foreign('idPregunta')
                        ->references('id')
                        ->on('preguntas')
                        ->onDelete('cascade');
            });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('subpreguntas');
    }
}
