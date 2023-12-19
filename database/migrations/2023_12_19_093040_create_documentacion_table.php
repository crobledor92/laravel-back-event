<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDocumentacionTable extends Migration
{
    public function up()
    {
        Schema::create('documentacion', function (Blueprint $table) {
            $table->id('Id_presentacion');
            $table->unsignedBigInteger('Id_acto');
            $table->string('Localizacion_documentacion', 100);
            $table->integer('Orden');
            $table->unsignedBigInteger('Id_persona');
            $table->string('Titulo_documento', 100);
            $table->timestamps();

            $table->foreign('Id_acto')->references('Id_acto')->on('actos');
            $table->foreign('Id_persona')->references('Id_persona')->on('personas');
        });
    }

    public function down()
    {
        Schema::dropIfExists('documentacion');
    }
}
