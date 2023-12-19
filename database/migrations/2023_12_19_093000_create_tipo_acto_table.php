<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTipoActoTable extends Migration
{
    public function up()
    {
        Schema::create('tipo_acto', function (Blueprint $table) {
            $table->id('id_tipo_acto');
            $table->string('descripcion', 100);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('tipo_acto');
    }
}
