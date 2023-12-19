<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ActosSeeder extends Seeder
{
    public function run()
    {
        DB::table('actos')->insert([
            [
                'id_acto' => 5,
                'fecha' => '2023-12-01',
                'hora' => '08:00:00',
                'titulo' => 'Evento 1',
                'descripcion_corta' => 'Descripción corta 1',
                'descripcion_larga' => 'Descripción larga 1',
                'num_asistentes' => 100,
                'id_tipo_acto' => 1,
            ],
            [
                'id_acto' => 6,
                'fecha' => '2023-12-05',
                'hora' => '14:30:00',
                'titulo' => 'Evento 2',
                'descripcion_corta' => 'Descripción corta 2',
                'descripcion_larga' => 'Descripción larga 2',
                'num_asistentes' => 150,
                'id_tipo_acto' => 2,
            ],
            [
                'id_acto' => 7,
                'fecha' => '2023-12-10',
                'hora' => '18:45:00',
                'titulo' => 'Evento 3',
                'descripcion_corta' => 'Descripción corta 3',
                'descripcion_larga' => 'Descripción larga 3',
                'num_asistentes' => 120,
                'id_tipo_acto' => 1,
            ],
            [
                'id_acto' => 8,
                'fecha' => '2023-12-20',
                'hora' => '10:15:00',
                'titulo' => 'Evento 4',
                'descripcion_corta' => 'Descripción corta 4',
                'descripcion_larga' => 'Descripción larga 4',
                'num_asistentes' => 80,
                'id_tipo_acto' => 2,
            ],
        ]);
    }
}
