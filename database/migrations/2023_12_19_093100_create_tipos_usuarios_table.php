<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTiposUsuariosTable extends Migration
{
    public function up()
    {
        Schema::create('tipos_usuarios', function (Blueprint $table) {
            $table->id('id_tipo_usuario');
            $table->string('descripcion', 100);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('tipos_usuarios');
    }
}
