<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TipoActoSeeder extends Seeder
{
    public function run()
    {
        DB::table('tipo_acto')->insert([
            ['Id_tipo_acto' => 1, 'Descripcion' => 'Acto de tipo 1'],
            ['Id_tipo_acto' => 2, 'Descripcion' => 'Acto de tipo 2'],
        ]);
    }
}