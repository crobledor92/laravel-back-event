<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsuariosTable extends Migration
{
    public function up()
    {
        Schema::create('usuarios', function (Blueprint $table) {
            $table->id('Id_usuario');
            $table->string('Username', 100);
            $table->string('Password', 100);
            $table->unsignedBigInteger('Id_Persona');
            $table->unsignedBigInteger('Id_tipo_usuario');
            $table->string('mail', 40);
            $table->timestamps();

            $table->foreign('Id_Persona')->references('Id_persona')->on('personas');
            $table->foreign('Id_tipo_usuario')->references('Id_tipo_usuario')->on('tipos_usuarios');
        });
    }

    public function down()
    {
        Schema::dropIfExists('usuarios');
    }
}
