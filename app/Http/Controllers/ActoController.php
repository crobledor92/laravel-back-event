<?php

namespace App\Http\Controllers;

use App\Models\Acto;
use Illuminate\View\View;

class ActoController extends Controller {

    public function getActos() {
        $actoModel = new Acto();
        $actos = $actoModel->getActos();
        return $actos;
    }

    public function showPersonalPanel(): View {
        (new SessionController())->shareData();
        $actoController = new ActoController();
        $actos = $this->getActos();
        return view('personal-panel', ['actos' => $actos]);
    }
}

public function AddActo(Request $request)
{
    // Validaciones
    $request->validate([
        'fecha' => 'required|date',
        'hora' => 'required|date_format:H:i', // Validación para el formato de hora (HH:mm)
        'titulo' => 'required|string',
        'resumen' => 'required|string',
        'descripcion' => 'required|string',
        'asistentes' => 'required|integer',
        'tipoActo' => 'required', // Ajusta según el tipo de datos que esperas para tipoActo
        'personasId' => 'required|array', // Asegúrate de que sea un array
        'personasId.*' => 'exists:personas,Id_persona', // Asegúrate de que las personas existan en la tabla personas
    ]);

    // Crear un nuevo acto
    $acto = new Acto;
    $acto->fecha = $request->input('fecha');
    // Asignar otros campos

    // Guardar en la base de datos
    $acto->save();

    return redirect('/actos')->with('success', 'Acto añadido correctamente');
}