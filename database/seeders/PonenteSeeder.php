<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PonenteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('lista_ponentes')->insert([
            ['id_persona' => 1, 'id_acto' => 5, 'orden' => 1],
            ['id_persona' => 2, 'id_acto' => 6, 'orden' => 2],
            ['id_persona' => 3, 'id_acto' => 7, 'orden' => 3],
        ]);
    }
}
