<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Acto extends Model {

    public function getActos() {
        $actos = DB::table('actos')->get();
        return $actos;
    }

    public function addActo($actoData) {
        DB::table('actos')->insert([
            'fecha' => $actoData['fecha'],
            'hora' => $actoData['hora'],
            'titulo' => $actoData['titulo'],
            'descripcion_corta' => $actoData['descripcion_corta'],
            'descripcion_larga' => $actoData['descripcion_larga'],
            'num_asistentes' => $actoData['num_asistentes'],
            'id_tipo_acto' => $actoData['id_tipo_acto'],
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    public function updateActo($actoData) {
        DB::table('actos')
            ->where('id_acto', $actoData['id_acto'])
            ->update([
            'fecha' => $actoData['fecha'],
            'hora' => $actoData['hora'],
            'titulo' => $actoData['titulo'],
            'descripcion_corta' => $actoData['descripcion_corta'],
            'descripcion_larga' => $actoData['descripcion_larga'],
            'num_asistentes' => $actoData['num_asistentes'],
            'id_tipo_acto' => $actoData['id_tipo_acto'],
            'updated_at' => now(),
        ]);
    }

    public function deleteActo($idActo) {
        DB::table('actos')->where('id_acto', $idActo)->delete();
    }
}