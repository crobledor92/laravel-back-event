<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PersonasSeeder extends Seeder
{
    public function run()
    {
        DB::table('personas')->insert([
            ['Id_persona' => 1, 'Nombre' => 'Ismael', 'Apellido1' => 'Flores', 'Apellido2' => 'Rubio'],
            ['Id_persona' => 2, 'Nombre' => 'Cristian', 'Apellido1' => 'Robledo', 'Apellido2' => 'Ramos'],
            ['Id_persona' => 3, 'Nombre' => 'Hector', 'Apellido1' => 'Rubio', 'Apellido2' => 'Gil'],
        ]);
    }
}