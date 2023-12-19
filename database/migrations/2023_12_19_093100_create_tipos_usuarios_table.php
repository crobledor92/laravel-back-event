<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTiposUsuariosTable extends Migration
{
    public function up()
    {
        Schema::create('tipos_usuarios', function (Blueprint $table) {
            $table->id('Id_tipo_usuario');
            $table->string('Descripcion', 100);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('tipos_usuarios');
    }
}
