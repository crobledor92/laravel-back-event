<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ActosSeeder extends Seeder{
    public function run(){
        DB::table('actos')->insert([
            [
                'id_acto' => 1,
                'fecha' => '2023-11-15',
                'hora' => '10:00:00',
                'titulo' => 'JavaScript Workshop',
                'descripcion_corta' => 'Taller práctico de JavaScript',
                'descripcion_larga' => 'Aprende JavaScript de manera práctica con nuestro taller intensivo.',
                'num_asistentes' => 80,
                'id_tipo_acto' => 1,
            ],
            [
                'id_acto' => 2,
                'fecha' => '2023-11-20',
                'hora' => '13:45:00',
                'titulo' => 'Python Fundamentals',
                'descripcion_corta' => 'Fundamentos de Python',
                'descripcion_larga' => 'Curso introductorio sobre los fundamentos de Python para principiantes.',
                'num_asistentes' => 120,
                'id_tipo_acto' => 2,
            ],
            [
                'id_acto' => 3,
                'fecha' => '2023-12-02',
                'hora' => '09:30:00',
                'titulo' => 'React Masterclass',
                'descripcion_corta' => 'Masterclass de React',
                'descripcion_larga' => 'Profundiza en React con nuestra masterclass dirigida por expertos en la materia.',
                'num_asistentes' => 100,
                'id_tipo_acto' => 1,
            ],
            [
                'id_acto' => 4,
                'fecha' => '2023-12-10',
                'hora' => '15:00:00',
                'titulo' => 'Java Advanced Topics',
                'descripcion_corta' => 'Temas avanzados de Java',
                'descripcion_larga' => 'Explora temas avanzados de Java, incluyendo concurrencia y programación funcional.',
                'num_asistentes' => 150,
                'id_tipo_acto' => 2,
            ],
            [
                'id_acto' => 5,
                'fecha' => '2023-01-05',
                'hora' => '11:30:00',
                'titulo' => 'PHP Symposium',
                'descripcion_corta' => 'Simposio sobre PHP',
                'descripcion_larga' => 'Participa en nuestro simposio anual dedicado a PHP con destacados ponentes de la comunidad.',
                'num_asistentes' => 120,
                'id_tipo_acto' => 1,
            ],
            [
                'id_acto' => 6,
                'fecha' => '2023-01-20',
                'hora' => '14:15:00',
                'titulo' => 'C# Workshop',
                'descripcion_corta' => 'Taller práctico de C#',
                'descripcion_larga' => 'Sumérgete en C# con nuestro taller práctico diseñado para desarrolladores intermedios.',
                'num_asistentes' => 90,
                'id_tipo_acto' => 2,
            ],
            [
                'id_acto' => 7,
                'fecha' => '2023-01-28',
                'hora' => '12:00:00',
                'titulo' => 'Ruby on Rails Bootcamp',
                'descripcion_corta' => 'Bootcamp de Ruby on Rails',
                'descripcion_larga' => 'Participa en nuestro bootcamp intensivo de Ruby on Rails y acelera tu aprendizaje.',
                'num_asistentes' => 80,
                'id_tipo_acto' => 1,
            ],
            [
                'id_acto' => 8,
                'fecha' => '2023-12-15',
                'hora' => '09:00:00',
                'titulo' => 'Web Development Crash Course',
                'descripcion_corta' => 'Curso intensivo de desarrollo web',
                'descripcion_larga' => 'Aprende los conceptos básicos del desarrollo web en nuestro curso intensivo de un día.',
                'num_asistentes' => 100,
                'id_tipo_acto' => 2,
            ],
            [
                'id_acto' => 9,
                'fecha' => '2023-11-25',
                'hora' => '16:30:00',
                'titulo' => 'Swift for Beginners',
                'descripcion_corta' => 'Swift para principiantes',
                'descripcion_larga' => 'Curso diseñado para principiantes que deseen aprender programación iOS con Swift.',
                'num_asistentes' => 110,
                'id_tipo_acto' => 1,
            ],
            [
                'id_acto' => 10,
                'fecha' => '2023-12-28',
                'hora' => '10:45:00',
                'titulo' => 'Go Programming Workshop',
                'descripcion_corta' => 'Taller de programación en Go',
                'descripcion_larga' => 'Explora la programación en Go con nuestro taller práctico dirigido por expertos en el lenguaje.',
                'num_asistentes' => 130,
                'id_tipo_acto' => 2,
            ],
        ]);
    }
}