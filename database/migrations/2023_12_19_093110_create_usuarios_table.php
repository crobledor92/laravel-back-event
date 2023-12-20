<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsuariosTable extends Migration
{
    public function up()
    {
        Schema::create('usuarios', function (Blueprint $table) {
            $table->id('id_usuario');
            $table->string('username', 100);
            $table->string('password', 100);
            $table->unsignedBigInteger('id_persona');
            $table->unsignedBigInteger('id_tipo_usuario');
            $table->string('email', 40);
            $table->timestamps();
            
            $table->foreign('id_persona')->references('id_persona')->on('personas');
            $table->foreign('id_tipo_usuario')->references('id_tipo_usuario')->on('tipos_usuarios');
        });
    }

    public function down()
    {
        Schema::dropIfExists('usuarios');
    }
}
