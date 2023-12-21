<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TipoActoSeeder extends Seeder
{
    public function run()
    {
        DB::table('tipo_acto')->insert([
            ['id_tipo_acto' => 1, 'descripcion' => 'Conferencia'],
            ['id_tipo_acto' => 2, 'descripcion' => 'Mesa redonda'],
        ]);
    }
}