@include('common/session')
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel personal - Back Event</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="icon" href="img/favicon.ico" type="image/x-icon">
</head>
<body>
@include('common/navegation')
<main>
    <div class="container">
        <h1>Calendario de eventos:</h1>
        @foreach($eventos as $evento)
            <p>{{ $evento->nombre }}</p>
        @endforeach
        @include('layout/calendar')
    </div>
</main>
@include('common/footer')