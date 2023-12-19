<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDocumentacionTable extends Migration
{
    public function up()
    {
        Schema::create('documentacion', function (Blueprint $table) {
            $table->id('id_presentacion');
            $table->unsignedBigInteger('id_acto');
            $table->string('localizacion_documentacion', 100);
            $table->integer('orden');
            $table->unsignedBigInteger('id_persona');
            $table->string('titulo_documento', 100);
            $table->timestamps();

            $table->foreign('id_acto')->references('id_acto')->on('actos');
            $table->foreign('id_persona')->references('id_persona')->on('personas');
        });
    }

    public function down()
    {
        Schema::dropIfExists('documentacion');
    }
}
