<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubopcionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subopciones', function (Blueprint $table) {
            $table->string('descripcion');
            $table->unsignedBigInteger('idSubpregunta');
                $table->foreign('idSubpregunta')
                        ->references('id')
                        ->on('subpreguntas')
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
        Schema::dropIfExists('subopciones');
    }
}
