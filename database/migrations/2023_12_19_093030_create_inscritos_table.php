<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInscritosTable extends Migration
{
    public function up()
    {
        Schema::create('inscritos', function (Blueprint $table) {
            $table->id('id_inscripcion');
            $table->unsignedBigInteger('id_persona');
            $table->unsignedBigInteger('id_acto');
            $table->datetime('fecha_inscripcion');
            $table->timestamps();

            $table->foreign('id_persona')->references('id_persona')->on('personas');
            $table->foreign('id_acto')->references('id_acto')->on('actos');
        });
    }

    public function down()
    {
        Schema::dropIfExists('inscritos');
    }
}

