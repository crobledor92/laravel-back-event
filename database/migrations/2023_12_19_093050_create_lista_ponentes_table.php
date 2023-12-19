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
            $table->unsignedBigInteger('Id_persona');
            $table->unsignedBigInteger('Id_acto');
            $table->integer('Orden');
            $table->timestamps();

            $table->foreign('Id_persona')->references('Id_persona')->on('personas');
            $table->foreign('Id_acto')->references('Id_acto')->on('actos');
        });
    }

    public function down()
    {
        Schema::dropIfExists('lista_ponentes');
    }
}
