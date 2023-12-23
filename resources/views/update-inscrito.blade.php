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
        <form class="" action="{{ route('update-inscrito.post') }}" method="post">
             @csrf
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
                <td>{{ $inscrito->Nombre }}</td>
                <td>{{ $inscrito->Apellido1 . " " . $inscrito->Apellido2 }}</td>
                <td>
                    <a href="{{ route('admin-panel', ['id_persona' => $inscrito->id_persona, 'id_acto' => session('actoIdModificando')]) }}">X</a>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

    </main>
</body>
</html>