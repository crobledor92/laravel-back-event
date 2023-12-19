<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TipoActoSeeder extends Seeder
{
    public function run()
    {
        DB::table('tipo_acto')->insert([
            ['id_tipo_acto' => 1, 'descripcion' => 'Acto de tipo 1'],
            ['id_tipo_acto' => 2, 'descripcion' => 'Acto de tipo 2'],
        ]);
    }
}