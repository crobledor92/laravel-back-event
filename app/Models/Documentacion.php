<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Documentacion extends Model {

    protected $table = 'documentacion';

    protected $primaryKey = 'id_presentacion';

    protected $fillable = [
        'orden',
    ];


    public function getFilesModel() {
        return DB::table('documentacion')->get();
    }
    public function getFilesById($id_acto) {
        return DB::table('documentacion')->where('id_acto', $id_acto)->get();
    }
    public function getFilesPersonaModel($id_persona) {
        return DB::table('documentacion')->where('id_persona', $id_persona)->get();
    }
    public function getFileDataById($id_presentacion) {
        return DB::table('documentacion')
            ->where('id_presentacion', $id_presentacion)
            ->first();
    }
    public function getNameFilesByIDModel($id_presentacion) {
        return DB::table('documentacion')
            ->where('id_presentacion', $id_presentacion)
            ->value('nombre_documento');
    }        
    public function addFileModel($data) {
        return DB::table('documentacion')->insert(['id_acto' => $data['id_acto'],'nombre_documento' => $data['nombre_documento'],'id_persona' => $data['id_persona'],'titulo_documento' => $data['titulo_documento'],'created_at' => now(),'updated_at' => now(),]);
    }
    public function deleteFileModel($id_file) {
        return DB::table('documentacion')->where('id_presentacion', $id_file)->delete();
    }
    public function updateOrder($idPresentacion, $newOrden) {
        $record = Documentacion::where('id_presentacion', $idPresentacion)->first();

        if ($record) {
            $record->update(['orden' => $newOrden], ['updated_at' => now()]);
            return 1;
        }
        return 0;
    }
}