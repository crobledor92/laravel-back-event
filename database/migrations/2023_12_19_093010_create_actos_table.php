<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActosTable extends Migration
{
    public function up()
    {
        Schema::create('actos', function (Blueprint $table) {
            $table->id('id_acto');
            $table->date('fecha');
            $table->time('hora');
            $table->string('titulo', 100);
            $table->string('descripcion_corta', 2000);
            $table->text('descripcion_larga');
            $table->integer('num_asistentes');
            $table->unsignedBigInteger('id_tipo_acto');
            $table->timestamps();

            $table->foreign('id_tipo_acto')->references('id_tipo_acto')->on('tipo_acto');
        });
    }

    public function down()
    {
        Schema::dropIfExists('actos');
    }
}