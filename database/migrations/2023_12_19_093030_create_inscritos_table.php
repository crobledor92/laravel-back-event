<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInscritosTable extends Migration
{
    public function up()
    {
        Schema::create('inscritos', function (Blueprint $table) {
            $table->id('Id_inscripcion');
            $table->unsignedBigInteger('Id_persona');
            $table->unsignedBigInteger('id_acto');
            $table->datetime('Fecha_inscripcion');
            $table->timestamps();

            $table->foreign('Id_persona')->references('Id_persona')->on('personas');
            $table->foreign('id_acto')->references('Id_acto')->on('actos');
        });
    }

    public function down()
    {
        Schema::dropIfExists('inscritos');
    }
}

