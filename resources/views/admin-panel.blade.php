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
    <h1>Panel de administrador</h1>
    <h2>Ajustes de actos:</h2>
    <table>
        <thead>
            <tr class='data'>
                <th>Fecha</th>
                <th>Hora</th>
                <th>Título</th>
                <th>Descripción Corta</th>
                <th>Acciones</th>
            </tr>
        </thead>
    @if(count($actos) > 0)    
        <tbody>
        @foreach($actos as $acto)
            <tr class="data">
                <td>{{ $acto->fecha }}</td>
                <td>{{ $acto->hora }}</td>
                <td>{{ $acto->titulo }}</td>
                <td>{{ $acto->descripcion_corta }}</td>
                <td >
                    <div class="acciones">
                        <a href='controller/update_acto_controller.php?acto_id={{ $acto->id_acto }}' class='secondary_a'>Modificar acto</a>
                        <a href='controller/update_inscritos_controller.php?acto_id={{ $acto->id_acto }}' class='secondary_a'>Modificar inscritos</a>
                    </div>
                </td>
            </tr>
        @endforeach
        </tbody>
    @endif
    </table>
    <div class="full_content"><a href='controller/add_acto_controller.php' class="add_acto">Añadir un nuevo acto</a></div>  
        <h2>Ajustes de tipo de actos:</h2>
        <table>
            <thead>
                <tr class="data">
                    <th>ID_Tipo</th>
                    <th>Descripción</th>
                    <th>Accion</th>
                </tr>
            </thead>
            <tbody> 
                @if(count($tiposActo) > 0)
                    @foreach($tiposActo as $tipoActo)
                        <tr class="data">
                            <td>PHP_ECHO=$tipoActo->id_tipo_actoEND_PHP</td>
                            <td style="text-wrap:nowrap">
                                <label for="inputPHP_ECHO=$tipoActo->id_tipo_actoEND_PHP" name="Editar">Editar esta descripcion (Clic Aquí):</label>
                                <input name="desc" class="inputDesc" id="inputPHP_ECHO=$tipoActo->id_tipo_actoEND_PHP" value="PHP_ECHO=$tipoActo->descripcionEND_PHP"></td>
                            <td>
                                <div class="actions">
                                    <button data-id-type="PHP_ECHO=$tipoActo->id_tipo_actoEND_PHP" class="uploadDescriptionType">Modificar Descripcion</button>
                                    <button data-id-type="PHP_ECHO=$tipoActo->id_tipo_actoEND_PHP" class="deleteType">Eliminar</button>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                @endif
                <tr>
                    <td>Añade un nuevo tipo de acto:</td>
                    <td colspan="2"><form action="controller/tipoActo_controller.php" method="post" ><input type="text" name="descripcion" required><button tpye="submit" name="newTipoActo">Añadir Tipo de Acto</button></form></td>
                </tr>
            </tbody>
        </table>
        <h2>Ajustes de ponentes:</h2>
        <table>
            <thead>
                <tr class="data">
                    <th>Nombre Completo</th>
                    <th>Acto</th>
                    <th>Descripcion</th>
                    <th>Fecha</th>
                    <th>Accion</th>
                </tr>
            </thead>
            <tbody>
            @if(!is_null($ponentes) && (is_array($ponentes) || is_object($ponentes)))
                @foreach($ponentes as $ponente)
                <tr class="data">
                    <td>PHP_ECHO=$ponente->nombreEND_PHP</td>
                    <td>PHP_ECHO=$ponente->tituloEND_PHP</td>
                    <td>PHP_ECHO=$ponente->descripcion_cortaEND_PHP</td>
                    <td>PHP_ECHO=$ponente->fechaEND_PHP</td>
                    <td>
                        <div class="actions">
                            <button data-id-persona="PHP_ECHO=$ponente->id_personaEND_PHP" data-id-acto="PHP_ECHO=$ponente->id_actoEND_PHP" class="deletePonente">Eliminar</button>
                        </div>
                    </td>
                </tr>
                @endforeach 
            @else
                <tr>
                    <td colspan="5">NO EXISTEN PONENTES</td>
                </tr>
            @endif    
            @if(count($actos) > 0)
                <form action="controller/ponente_controller.php" method="post">           
                    <td>
                        <span>Lista de personas: </span>
                        <select name="id_persona">
                        @foreach($personas as $persona)   
                            <option value="{{ $persona->id_persona }}">{{ $persona->nombre }} {{ $persona->apellido1 }} {{ $persona->apellido2 }}</option>
                        @endforeach
                        </select>
                    </td>
                    <td>
                        <span>Lista de actos: </span>
                        <select name="id_acto">        
                        PHP foreach($listaActos as $acto): END_PHP
                            <option value="{{$acto->id_acto}}">{{$acto->fecha}} {{$acto->titulo}} {{$acto->descripcion_corta}}</option>
                        PHP endforeach; END_PHP                    
                        </select>
                    </td>
                    <td>- - - - -</td>
                    <td>- - - - -</td>
                    <td>
                        <button name="newPonente">Añadir Ponente</button>
                    </td>
                </form>
            @endif   
            </tr>
            </tbody>
        </table>
    <script>
    document.addEventListener('DOMContentLoaded', function () {
        var buttons = document.querySelectorAll('.deletePonente');
        buttons.forEach(function (button) {
            button.addEventListener('click', function () {
                var dataIDPersona = button.getAttribute('data-id-persona');
                var dataIDActo = button.getAttribute('data-id-acto');
                fetch('controller/ponente_controller.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                    },
                    body: 'ID_Persona=' + encodeURIComponent(dataIDPersona) + '&ID_Acto=' + encodeURIComponent(dataIDActo) + '&deletePonente=1',
                })
                .then(response => response.text())
                .then(data => {
                    if (data.error) {
                        alert(data.error);
                    }
                }
                )
                .catch(error => {
                    console.error('Error:', error);
                });
                setTimeout(function(){ location.reload(); }, 200);
            });
        });
    });
    document.addEventListener('DOMContentLoaded', function () {
        var buttons = document.querySelectorAll('.uploadDescriptionType');
        buttons.forEach(function (button) {
            button.addEventListener('click', function () {
                var dataIdType = button.getAttribute('data-id-type');
                var inputId = 'input' + dataIdType;
                var actual_description = document.getElementById(inputId).value;
                fetch('controller/tipoActo_controller.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                    },
                    body: 'Id_tipo_acto=' + encodeURIComponent(dataIdType) + '&updateDescTipoActo=1&Descripcion=' + encodeURIComponent(actual_description),
                })
                .then(response => response.text())
                .catch(error => {
                    console.error('Error:', error);
                });
                setTimeout(function(){ location.reload(); }, 200);
            });
        });
    });
    document.addEventListener('DOMContentLoaded', function () {
        var buttons = document.querySelectorAll('.deleteType');
        buttons.forEach(function (button) {
            button.addEventListener('click', function () {
                var dataIdType = button.getAttribute('data-id-type');
                fetch('controller/tipoActo_controller.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                    },
                    body: 'Id_tipo_acto=' + encodeURIComponent(dataIdType) + '&deleteTipoActo=1',
                })
                .then(response => response.json())
                .then(data => {
                    if (data.error) {
                        alert(data.error);
                    }
                }
                )
                .catch(error => {
                    alert("Hubo un problema intentando eliminar el tipo de acto");
                });
                setTimeout(function(){ location.reload(); }, 200);
            });
        });
    });
    </script>
    </div>
</main>
@include('common/footer')