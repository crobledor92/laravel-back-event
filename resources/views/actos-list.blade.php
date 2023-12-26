@include('common/session')
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar sesión - Back Event</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="icon" href="img/favicon.ico" type="image/x-icon">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
</head>
<body>
@include('common/navegation')
<main>
    <div class="container">
        <section>
            <form id="filter-actos">
                <label for="acto-status">Estado del acto</label>
                <select id="acto-status" name="acto-status">
                    <option value="todos">Todos</option>
                    <option value="inscrito">Inscrito</option>
                    <option value="ponente">Ponente</option>
                    <option value="noInscrito">No inscrito</option>
                </select>
                <button type="submit">Apply Filters</button>
            </form>
        </section>
        <section class="actos-list">
            @foreach($actos as $acto)
                <x-acto-card :data="$acto"/>
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
    function updateActos(filteredActos) {
        var actosContainer = $('.actos-list');
        actosContainer.empty();

        for (const key in filteredActos) {
            const acto = filteredActos[key];

            console.log(key)
            console.log(acto)

            var actoCardHTML = `<div class="acto"><div class="acto-summary"><div class="acto-date"><p>${acto.fecha}</p><p>${acto.hora}</p></div><div class="acto-title"><p>${acto.titulo}</p></div><div class="acto-details"><p class="grid-item">${acto.descripcion}</p><p class="grid-item">${acto.totalInscritos} / ${acto.num_asistentes}</p></div></div><input type="file" name="archivo" required><div class="acto-description"><p>${acto.descripcion_corta}</p></div></div>`

            // The new HTML string you want to insert
            var actoStatusHTML = acto.status === "ponente" ? '<div class="acto-status--ponente"><p class="grid-item">Ponente</p></div>' : acto.status === "inscrito" ? '<div class="acto-status--inscrito"><p class="grid-item">Inscrito</p></div>' : '<div class="acto-status--noInscrito"><p class="grid-item">No inscrito</p></div>'

            var tempDiv = document.createElement('div');
            tempDiv.innerHTML = actoCardHTML;

            // Find the target div with class "acto-details"
            var actoDetailsDiv = tempDiv.querySelector('.acto-details');

            // Insert the new HTML as the first child
            actoDetailsDiv.insertAdjacentHTML('afterbegin', actoStatusHTML);

            // Get the modified HTML
            var finishedActoCard = tempDiv.innerHTML;

            actosContainer.append(finishedActoCard);
        }
    };
    $('#filter-actos').submit(function (e) {
        e.preventDefault();

        var filters = {
            selectedStatus: $('#acto-status').val(),
            actos: @json($actos),
        };

        $.get("{!! route('actos-filtrados.get') !!}", filters)
            .done(function(response) {
                updateActos(response.filteredActos);
            })
            .fail(function(jqXHR, textStatus, errorThrown) {
                console.error('AJAX request failed:', textStatus, errorThrown);
            });
    });
</script>
@include('common/footer')
