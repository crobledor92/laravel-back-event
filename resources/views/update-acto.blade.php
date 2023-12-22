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
        <h1>Modificar acto</h1>
            <form class="" action="{{ route('update-acto.post') }}" method="post">
             @csrf
             <label>Fecha</label>
            <input type="date" name="fecha" value="{{ $actoData->fecha }}" required><br>

            <label>Hora</label>
            <input type="time" name="hora" value="{{ $actoData->hora }}" required><br>

            <label>Title</label>
            <input type="text" name="titulo" value="{{ $actoData->titulo }}" required><br>

            <label>Resumen</label>
            <input type="text" name="resumen" value="{{ $actoData->descripcion_corta }}" required><br>

            <label>Descripción</label>
            <input type="text" name="descripcion" value="{{ $actoData->descripcion_larga }}" required><br>

            <label>Número de asistentes</label>
            <input type="number" name="asistentes" value="{{ $actoData->num_asistentes }}" required><br>

            <label>Tipo de acto</label>
            <select name="tipoActo" required>
                @foreach($listaTiposActos as $tipo)
                    <option value="{{ $tipo->id_tipo_acto }}" {{ $actoData->id_tipo_acto == $tipo->id_tipo_acto ? 'selected' : '' }}>
                        {{ $tipo->descripcion }}
                    </option>
                @endforeach
            </select>
            <input type="submit" name="updateActo" value="Modificar curso"><br>
        </form>
    </main>
</body>
</html>