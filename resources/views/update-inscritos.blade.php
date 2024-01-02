@include('common/session')

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de administración - Back Event</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="icon" href="img/favicon.ico" type="image/x-icon">
</head>
<body>
@include('common/navegation')
    <main>
        <div class="container">
        <h1>Modificar usuarios inscritos</h1>            
            <table>
                <thead>
                    <tr class='data'>
                        <th>Nombre</th>
                        <th>Apellidos</th>
                        <th>Eliminar inscripción</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($inscritos as $inscrito)
                        <tr class="data">
                            <td>{{ $inscrito->nombre }}</td>
                            <td>{{ $inscrito->apellido1 . " " . $inscrito->apellido2 }}</td>
                            <td>
                            <form action="{{ route('delete-inscrito.delete') }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <input type="hidden" name="id_inscripcion" value="{{ $inscrito->id_inscripcion }}">
                                <input type="hidden" name="id_acto" value="{{ $inscrito->id_acto }}">
                                <button type="submit">X</button>
                            </form>
                            </td>
                        </tr>
                    @endforeach
                    <form action="{{ route('add-inscrito.post') }}" method="post">   
                        @csrf        
                        <input type="hidden" name="id_acto" value="{{ $actoId }}">
                        <td>
                            <span>Lista de personas: </span>
                            <select name="id_persona">
                            @foreach($personas as $persona)   
                                <option value="{{ $persona->id_persona }}">{{ $persona->nombre . ' ' . $persona->apellido1 . ' ' . $persona->apellido2 }}</option>
                            @endforeach
                            </select>
                        </td>
                        <td></td>
                        <td>
                            <button type="submit" name="newPonente">Añadir Ponente</button>
                        </td>
                    </form>
                </tbody>
            </table>
        </div>
    </main>
</body>
</html>