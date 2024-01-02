<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Acto extends Model {

    public function getActos() {
        $actos = DB::table('actos')
            ->join('tipo_acto', 'tipo_acto.id_tipo_acto', '=', 'actos.id_tipo_acto')
            ->select('tipo_acto.*', 'actos.*')
            ->get();
        return $actos;
    }

    public function addActo($actoData) {
        $actoId = DB::table('actos')->insertGetId([
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

        return $actoId;
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
    public function getActoByIDModel($id) {
        return DB::table('actos')
            ->where('actos.id_acto', $id)
            ->join('tipo_acto', 'tipo_acto.id_tipo_acto', '=', 'actos.id_tipo_acto')
            ->leftJoin('lista_ponentes', 'lista_ponentes.id_acto', '=', 'actos.id_acto')
            ->leftJoin('inscritos', 'inscritos.id_acto', '=', 'actos.id_acto')
            ->leftJoin('documentacion', 'documentacion.id_acto', '=', 'actos.id_acto')
            ->select(
                'actos.id_acto',
                'actos.fecha',
                'actos.hora',
                'actos.titulo',
                'actos.descripcion_corta',
                'actos.descripcion_larga',
                'actos.num_asistentes',
                'tipo_acto.descripcion',
                DB::raw('GROUP_CONCAT(DISTINCT lista_ponentes.id_ponente) as ponentes'),
                DB::raw('GROUP_CONCAT(DISTINCT inscritos.id_inscripcion) as inscritos'),
                DB::raw('GROUP_CONCAT(DISTINCT documentacion.id_presentacion) as documentacion')
            )
            ->groupBy('actos.id_acto', 'actos.fecha', 'actos.hora', 'actos.titulo', 'actos.descripcion_corta', 'actos.descripcion_larga', 'actos.num_asistentes', 'tipo_acto.descripcion')
            ->first();
    }
}