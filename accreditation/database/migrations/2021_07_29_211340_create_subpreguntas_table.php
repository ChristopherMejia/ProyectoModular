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
                $table->string('tipo');
                $table->string('descripcion');
                $table->string('opciones')->nullable();
                $table->unsignedBigInteger('pregunta_id');
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
