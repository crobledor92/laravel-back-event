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
        <section class="filter">
            <span class="filter_text">Filtro: </span>
            <div>
                <label>
                    <span>Inscritos: </span><input type="checkbox" id="checkboxInscritos" checked>
                </label>
                <label>
                    <span>Ponente: </span><input type="checkbox" id="checkboxPonente" checked>
                </label>                
                <label>
                    <span>No inscritos: </span><input type="checkbox" id="checkboxNoInscritos" checked>
                </label>
            </div>
        </section>
        <section class="actos-list">
            @foreach($actos as $acto)
                <x-acto-card :data="$acto" :idPersona="$idPersona"/>
            @endforeach
            <div id="popup-background"></div>
        </section>   
    </div>
</main>
<script>
    const checkboxInscritos = document.getElementById('checkboxInscritos');
    const checkboxNoInscritos = document.getElementById('checkboxNoInscritos');
    const checkboxPonente = document.getElementById('checkboxPonente');
    function actualizarVisualizacion() {
        const actos = document.querySelectorAll('.acto');
        console.log("eventlistener is triggered");
        actos.forEach(acto => {
            console.log("New acto iteration")
            const esInscrito = acto.querySelector('.acto-status--inscrito') !== null;
            const esPonente = acto.querySelector('.acto-status--ponente') !== null;
            const esNoInscrito = acto.querySelector('.acto-status--noInscrito') !== null;
            console.log("Inscrito: ", esInscrito);
            console.log("ponente: ", esPonente);
            console.log("NO inscrito: ", esNoInscrito);
            
            if ((esInscrito && checkboxInscritos.checked) ||
                (esNoInscrito && checkboxNoInscritos.checked) ||
                (esPonente && checkboxPonente.checked)) {
                acto.style.display = 'block';
            } else {
                acto.style.display = 'none';
            }
        });
    }
    checkboxInscritos.addEventListener('change', actualizarVisualizacion);
    checkboxNoInscritos.addEventListener('change', actualizarVisualizacion);
    checkboxPonente.addEventListener('change', actualizarVisualizacion);
    actualizarVisualizacion();
</script>
@include('common/footer')