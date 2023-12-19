<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PersonasSeeder extends Seeder
{
    public function run()
    {
        DB::table('personas')->insert([
            ['id_persona' => 1, 'nombre' => 'Ismael', 'apellido1' => 'Flores', 'apellido2' => 'Rubio'],
            ['id_persona' => 2, 'nombre' => 'Cristian', 'apellido1' => 'Robledo', 'apellido2' => 'Ramos'],
            ['id_persona' => 3, 'nombre' => 'Hector', 'apellido1' => 'Rubio', 'apellido2' => 'Gil'],
        ]);
    }
}