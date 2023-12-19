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
                'Id_acto' => 5,
                'Fecha' => '2023-12-01',
                'Hora' => '08:00:00',
                'Titulo' => 'Evento 1',
                'Descripcion_corta' => 'Descripción corta 1',
                'Descripcion_larga' => 'Descripción larga 1',
                'Num_asistentes' => 100,
                'Id_tipo_acto' => 1,
            ],
            [
                'Id_acto' => 6,
                'Fecha' => '2023-12-05',
                'Hora' => '14:30:00',
                'Titulo' => 'Evento 2',
                'Descripcion_corta' => 'Descripción corta 2',
                'Descripcion_larga' => 'Descripción larga 2',
                'Num_asistentes' => 150,
                'Id_tipo_acto' => 2,
            ],
            [
                'Id_acto' => 7,
                'Fecha' => '2023-12-10',
                'Hora' => '18:45:00',
                'Titulo' => 'Evento 3',
                'Descripcion_corta' => 'Descripción corta 3',
                'Descripcion_larga' => 'Descripción larga 3',
                'Num_asistentes' => 120,
                'Id_tipo_acto' => 1,
            ],
            [
                'Id_acto' => 8,
                'Fecha' => '2023-12-20',
                'Hora' => '10:15:00',
                'Titulo' => 'Evento 4',
                'Descripcion_corta' => 'Descripción corta 4',
                'Descripcion_larga' => 'Descripción larga 4',
                'Num_asistentes' => 80,
                'Id_tipo_acto' => 2,
            ],
        ]);
    }
}
