<?php
namespace App\Http\Controllers;

use App\Models\Documentacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

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
            'archivo.*' => 'required|file|mimes:pdf,doc,docx|max:2048',
            'id_acto' => 'required|numeric',
            'id_persona' => 'required|numeric',
        ]);

        $newFiles = $request->file('archivo');
        $filesUploaded = 0;

        foreach ($newFiles as $file) {
            $nombreOriginal = $file->getClientOriginalName();
            $rutaAlmacenada = $file->store('files', 'public');
            $data = [
                'id_acto' => $request->input('id_acto'),
                'nombre_documento' => basename($rutaAlmacenada),
                'fecha_inscripcion' => now(),
                'id_persona' => $request->input('id_persona'),
                'titulo_documento' => $nombreOriginal,
            ];
            $status = (new Documentacion())->addFileModel($data);
            $filesUploaded += $status;
        }

        if($filesUploaded === count($newFiles)){
            return redirect()->route('listado-actos.get')->with(['success', 'Archivo subido correctamente.']);
        }
    }

    public function updateFilesOrder(Request $request) {
        try {
            $documentos = $request->input('documentos');
            $filesUpdated = 0;
            
            
            foreach ($documentos as $documento) {
                $status = (new Documentacion())->updateOrder($documento['id_presentacion'], $documento['orden']);
                $filesUpdated += $status;
            }
            return response()->json(["success" => true]);
    
            if($filesUploaded === count($documentos)){
                return redirect()->route('listado-actos.get')->with(['success', 'Archivo subido correctamente.']);
            }
        } catch (\Exception $e) {
            \Log::error($e);
            return response()->json(['error' => $e], 500);
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