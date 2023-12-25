@include('common/session')
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar sesión - Back Event</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="icon" href="img/favicon.ico" type="image/x-icon">
</head>
<body>
@include('common/navegation')
<main>
    <div class="container">
        <section class="actos-list">
            @foreach($actos as $acto)
                <div class="acto">
                    <div class="acto-summary">
                        <div class="acto-date">
                            <p>{{ $acto->fecha}}</p>
                            <p>{{ $acto->hora}}</p>
                        </div>
                        <div class="acto-title">
                            <p>{{ $acto->titulo}}</p>
                        </div>
                        <div class="acto-details">
                            <x-acto-status :status="$acto->status"/>
                            <p class="grid-item">{{ $acto->descripcion}} </p>
                            <p class="grid-item">{{ $acto->totalInscritos}} / {{ $acto->num_asistentes}}</p>
                        </div>
                    </div>
                    <div class="acto-description">
                        <p>{{ $acto->descripcion_corta}}</p>
                    </div>
                </div>
            @endforeach
        </section>
        <h1>{{ $idPersona }}</h1>     
    </div>
</main>
@include('common/footer')