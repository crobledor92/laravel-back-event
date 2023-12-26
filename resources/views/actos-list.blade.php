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
        <section>
            <form id="filter-actos">
                <label for="acto-status">Estado del acto</label>
                <select id="acto-status" name="acto-status">
                    <option value="inscrito">Inscrito</option>
                    <option value="ponente">Ponente</option>
                    <option value="noInscrito">No inscrito</option>
                </select>
                <button type="submit">Apply Filters</button>
            </form>
        </section>
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
                    <input type="file" name="archivo" required>
                    <div class="acto-description">
                        <p>{{ $acto->descripcion_corta}}</p>
                    </div>
                </div>
            @endforeach
        </section>   
        <form method="post" action="{{ route('addFile.post') }}" enctype="multipart/form-data">
            @csrf
            <fieldset>
                <legend>Nuevo Registro:</legend>
                <label for="archivo">Archivo:</label>
                <input type="file" name="archivo"><br>
                <label for="id_acto">id_acto</label>
                <input type="text" name="id_acto"><br>
                <label for="id_persona">id_persona</label>
                <input type="text" name="id_persona"><br>
                <input type="submit" value="Registrarse"><br>
            </fieldset>
        </form>        
    </div>
</main>
<script>
    $('#filter-actos').submit(function (e) {
        e.preventDefault();

        var filters = {
            selectedStatus: $('#acto-status').val(),
            actos: {!! json_encode($actos)!!}
        };

        $.ajax({
            url: route('actos-filtrados.get'),
            type: 'GET',
            data: filters,
            success: function(response) {
                updateActos(response.events);
            }
        });
    });

    function updateActos(filteredActos) {
        var actosContainer = $('.actos-list');

        actosContainer.empty();

        filteredActos.forEach(function (event) {
            // Create and append HTML elements for each event
            var eventHtml = '<div>' + event.name + '</div>'; // Adjust this based on your event structure
            actosContainer.append(eventHtml);
        });
    }
</script>
@include('common/footer')
