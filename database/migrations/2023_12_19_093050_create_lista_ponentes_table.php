<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateListaPonentesTable extends Migration
{
    public function up()
    {
        Schema::create('lista_ponentes', function (Blueprint $table) {
            $table->id('id_ponente');
            $table->unsignedBigInteger('id_persona');
            $table->unsignedBigInteger('id_acto');
            $table->integer('orden');
            $table->timestamps();

            $table->foreign('id_persona')->references('id_persona')->on('personas');
            $table->foreign('id_acto')->references('id_acto')->on('actos');
        });
    }

    public function down()
    {
        Schema::dropIfExists('lista_ponentes');
    }
}
