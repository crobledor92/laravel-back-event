<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActosTable extends Migration
{
    public function up()
    {
        Schema::create('actos', function (Blueprint $table) {
            $table->id('Id_acto');
            $table->date('Fecha');
            $table->time('Hora');
            $table->string('Titulo', 100);
            $table->string('Descripcion_corta', 2000);
            $table->text('Descripcion_larga');
            $table->integer('Num_asistentes');
            $table->unsignedBigInteger('Id_tipo_acto');
            $table->timestamps();

            $table->foreign('Id_tipo_acto')->references('Id_tipo_acto')->on('tipo_acto');
        });
    }

    public function down()
    {
        Schema::dropIfExists('actos');
    }
}