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
        <h1>Añadir un curso</h1>
            <label>Fecha</label>
            <input type="date" name="fecha" required><br>
            <label>Hora</label>
            <input type="time" name="hora" required><br>
            <label>Title</label>
            <input type="text" name="titulo" required><br>
            <label>Resumen</label>
            <input type="text" name="resumen" required><br>
            <label>Descripción</label>
            <input type="text" name="descripcion" required><br>
            <label>Número de asistentes</label>
            <input type="number" name="asistentes" required><br>
            <label>Tipo de acto</label>
            <select name="tipoActo" required>
            @foreach($listaTiposActos as $tipo)
                <option value="{{ $tipo->id_tipo_acto }}">{{ $tipo->Descripcion }}</option>
            @endforeach

            </select>
            <label>Ponentes</label>
            <select name="personasId[]" multiple required>
            @foreach($personas as $persona)
                <option value="{{ $persona->id_persona }}">{{ $persona->Nombre . ' ' . $persona->apellido1 . ' ' . $persona->apellido2 }}</option>
            @endforeach
            </select>
            <input type="submit" name="addActo" value="Añadir curso"><br>
        </form>
    </main>
</body>
</html>