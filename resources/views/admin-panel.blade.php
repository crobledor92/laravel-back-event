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
        <div class="table">
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
                    <td>
                        <div class="acciones">
                            <a href="{{ route('get-acto-data.get', ['id' => $acto->id_acto]) }}" class="AddActo">
                                <button class="primary-button" type="button">Modificar acto</button>                            
                            </a>
                            <a href="{{ route('get-acto-inscritos.get', ['id' => $acto->id_acto]) }}" class="AddActo">
                                <button class="primary-button" type="button">Modificar inscritos</button>                            
                            </a>
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        @endif
        </table>
        <div class="full_content">
            <a href="{{ route('add-acto') }}" class="AddActo">
                <button class="primary-button" type="button">Añadir un nuevo acto</button>
            </a>
        </div>
        </div>
        <h2>Ajustes de tipo de actos:</h2>
        <div class="table">
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
                                <td>{{$tipoActo->id_tipo_acto}}</td>
                                <td style="text-wrap:nowrap">
                                    <label for="input{{$tipoActo->id_tipo_acto}}" name="Editar">Editar esta descripcion (Clic Aquí):</label>
                                    <input name="desc" class="inputDesc" id="input{{$tipoActo->id_tipo_acto}}" value="{{$tipoActo->descripcion}}">
                                </td>
                                <td>
                                    <div class="actions">
                                        <button data-id-type="{{ $tipoActo->id_tipo_acto }}" class="uploadDescriptionType primary-button">Modificar Descripcion</button>
                                        <button data-id-type="{{ $tipoActo->id_tipo_acto }}" class="deleteType primary-button">Eliminar</button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </form>
                    @endif
                    <tr>
                        <td>Añade un nuevo tipo de acto:</td>
                        <form action="{{ route('add-tipo-acto.post') }}" method="post" >
                            @csrf
                            <td>
                                <input type="text" name="descripcion" required>
                            </td>
                            <td>
                                <button class="primary-button" tpye="submit" name="newTipoActo">Añadir Tipo de Acto</button>
                            </td>
                        </form>
                    </tr>
                </tbody>
            </table>
        </div>
        <h2>Ajustes de ponentes:</h2>
        <div class="table">
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
                @if(count($ponentes) > 0)
                    @foreach($ponentes as $ponente)
                    <tr class="data">
                        <td>{{$ponente->nombre}}</td>
                        <td>{{$ponente->titulo}}</td>
                        <td>{{$ponente->descripcion_corta}}</td>
                        <td>{{$ponente->fecha}}</td>
                        <td>
                            <div class="actions">
                                <button data-id-persona="{{ $ponente->id_persona }}" data-id-acto="{{ $ponente->id_acto }}" class="deletePonente primary-button">Eliminar</button>
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
                    <form action="{{ route('add-ponente.post') }}" method="post">   
                        @csrf        
                        <td>
                            <span>Lista de personas: </span>
                            <select name="id_persona">
                            @foreach($personas as $persona)   
                                <option value="{{ $persona->id_persona }}">{{ $persona->nombre . ' ' . $persona->apellido1 . ' ' . $persona->apellido2 }}</option>
                            @endforeach
                            </select>
                        </td>
                        <td>
                        <span>Lista de actos: </span>
                        <select name="id_acto">
                            @foreach($actos as $acto)
                                <option value="{{ $acto->id_acto }}">{{ $acto->fecha . ' ' . $acto->titulo . ' ' . $acto->descripcion_corta }}</option>
                            @endforeach
                        </select>
                        </td>
                        <td></td>
                        <td></td>
                        <td>
                            <button class="primary-button" type="submit" name="newPonente">Añadir Ponente</button>
                        </td>
                    </form>
                @endif   
                </tr>
                </tbody>
            </table>
        </div>
    <script>
    document.addEventListener('DOMContentLoaded', function () {
        var buttons = document.querySelectorAll('.deletePonente');
        buttons.forEach(function (button) {
            button.addEventListener('click', function () {
                var dataIDPersona = button.getAttribute('data-id-persona');
                var dataIDActo = button.getAttribute('data-id-acto');
                fetch("{!! route('delete-ponente.delete') !!}", {
                    method: 'DELETE',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{!! csrf_token() !!}',
                    },
                    body: JSON.stringify({
                        id_persona: dataIDPersona,
                        id_acto: dataIDActo,
                    }),
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
                fetch("{!! route('update-tipo-acto.put') !!}", {
                    method: 'PUT',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{!! csrf_token() !!}',
                    },
                    body: JSON.stringify({
                        Id_tipo_acto: dataIdType,
                        Descripcion: actual_description,
                    }),
                })
                .then(res => console.log(res))
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
                fetch("{!! route('delete-tipo-acto.delete') !!}", {
                    method: 'DELETE',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{!! csrf_token() !!}',
                    },
                    body: JSON.stringify({
                        Id_tipo_acto: dataIdType,
                    }),
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