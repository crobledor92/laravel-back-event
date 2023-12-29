<?php
namespace App\Http\Controllers;

use App\Models\Documentacion;
use Illuminate\Http\Request;

class DocumentacionController extends Controller {
    //Obtiene todos los archivos registrados
    public function getFiles(){
        return (new Documentacion())->getFilesModel();
    }
    //Obtiene los archivos mediante id_persona
    public function getFilesPersona($id_persona,$id_acto) {
        return (new Documentacion())->getFilesPersonaModel($id_persona,$id_acto);
    }
    //Obtiene los archivos mediante id_presentacion
    public function getNameFilesByID(Request $request) {
        return (new Documentacion())->getNameFilesByIDModel($request->input('id_presentacion'));
    }
    //Permite validad, guardar y registrar en la base de datos un archivo.
    public function addFile(Request $request) {
        $request->validate([
            'archivo' => 'required|file|mimes:pdf,doc,docx|max:2048',
            'id_acto' => 'required|numeric',
            'id_persona' => 'required|numeric',
        ]);
        $nombreOriginal = $request->file('archivo')->getClientOriginalName();
        $rutaAlmacenada = $request->file('archivo')->store('files', 'public');
        $data = [
            'id_acto' => $request->input('id_acto'),
            'nombre_documento' => basename($rutaAlmacenada),
            'fecha_inscripcion' => now(),
            'id_persona' => $request->input('id_persona'),
            'titulo_documento' => $nombreOriginal,
        ];
        $status = (new Documentacion())->addFileModel($data);
        if($status){
            return redirect()->route('listado-actos.get')->with(['success', 'Archivo subido correctamente.']);
        }
    }
    //Permite eliminar el archivo del sitio web y su registro en la BD.
    public function deleteFile(Request $request) {
        $file_name = (new Documentacion())->getNameFilesByIDModel($request->input('id_presentacion'));
        $rutaArchivo = 'files/' . $file_name;
        if (Storage::exists($rutaArchivo)) {
            Storage::delete($rutaArchivo);
        } 
        return (new Documentacion())->deleteFileModel($request->input('id_presentacion'));
    }
}