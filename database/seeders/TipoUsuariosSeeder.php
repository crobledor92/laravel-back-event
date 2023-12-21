<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TipoUsuariosSeeder extends Seeder
{
    public function run()
    {
        DB::table('tipos_usuarios')->insert([
            [
                'id_tipo_usuario' => 1,
                'descripcion' => 'usuario',
            ],
            [
                'id_tipo_usuario' => 2,
                'descripcion' => 'ponente',
            ],
            [
                'id_tipo_usuario' => 3,
                'descripcion' => 'admin',
            ],
        ]);
    }
}
