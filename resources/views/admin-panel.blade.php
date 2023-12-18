@include('common/session')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de administración - Back Event</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="icon" href="img/favicon.ico" type="image/x-icon">
</head>
<body>
    @include('common/navegation')
    <main class="admin_panel">
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
    <?php
    if(count($listaActos) > 0) {?>    
        <tbody>
        <?php foreach($listaActos as $acto): ?>
            <tr class="data">
                <td><?=$acto->Fecha?></td>
                <td><?=$acto->Hora?></td>
                <td><?=$acto->Titulo?></td>
                <td><?=$acto->Descripcion_corta?></td>
                <td >
                    <div class="acciones">
                        <a href='controller/update_acto_controller.php?acto_id=<?=$acto->Id_acto?>' class='secondary_a'>Modificar acto</a>
                        <a href='controller/update_inscritos_controller.php?acto_id=<?=$acto->Id_acto?>' class='secondary_a'>Modificar inscritos</a>
                    </div>
                </td>
            </tr>
        <?php endforeach;}?>
        </tbody>
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
<?php 
if(count($listaTiposActos) > 0){
     foreach($listaTiposActos as $TipoActo): ?>
        <tr class="data">
            <td><?=$TipoActo->Id_tipo_acto?></td>
            <td style="text-wrap:nowrap">
                <label for="input<?=$TipoActo->Id_tipo_acto?>" name="Editar">Editar esta descripcion (Clic Aquí):</label>
                <input name="desc" class="inputDesc" id="input<?=$TipoActo->Id_tipo_acto?>" value="<?=$TipoActo->Descripcion?>"></td>
            <td>
                <div class="actions">
                    <button data-id-type="<?=$TipoActo->Id_tipo_acto?>" class="uploadDescriptionType">Modificar Descripcion</button>
                    <button data-id-type="<?=$TipoActo->Id_tipo_acto?>" class="deleteType">Eliminar</button>
                </div>
            </td>
        </tr>
    <?php endforeach;}?>
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
        <?php if (!is_null($listaInscripcionesPonentes) && (is_array($listaInscripcionesPonentes) || is_object($listaInscripcionesPonentes))) {
            foreach($listaInscripcionesPonentes as $Ponente): ?>
            <tr class="data">
                <td><?=$Ponente->NombreCompleto?></td>
                <td><?=$Ponente->Titulo_Acto?></td>
                <td><?=$Ponente->Description_Acto?></td>
                <td><?=$Ponente->Fecha_Acto?></td>
                <td>
                    <div class="actions">
                        <button data-id-persona="<?=$Ponente->ID_Persona?>" data-id-acto="<?=$Ponente->ID_Acto?>" class="deletePonente">Eliminar</button>
                    </div>
                </td>
            </tr>
        <?php endforeach;} else{?>
            <tr>
                <td colspan="5">NO EXISTEN PONENTES</td>
            </tr>
            <?php } ?>
            <?php if(count($listaActos) > 0) { ?>
            <form action="controller/ponente_controller.php" method="post">           
                    <td>
                        <span>Lista de personas: </span>
                        <select name="id_persona">
                        <?php foreach($personas as $persona):?>   
                                <option value="<?=$persona->Id_persona?>"><?=$persona->Nombre.' '.$persona->Apellido1.' '.$persona->Apellido2?></option>
                        <?php endforeach;?>
                        </select>
                    </td>
                    <td>
                        <span>Lista de actos: </span>
                        <select name="id_acto">        
                        <?php foreach($listaActos as $acto): ?>
                            <?php var_dump($acto); ?>
                            <option value="<?=$acto->Id_acto?>"><?=$acto->Fecha." - ".$acto->Titulo." - ".$acto->Descripcion_corta?></option>
                        <?php endforeach; ?>                    
                        </select>
                    </td>
                    <td>- - - - -</td>
                    <td>- - - - -</td>
                    <td>
                        <button name="newPonente">Añadir Ponente</button>
                    </td>
                </form>
            <?php } ?>    
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
</main>
</body>
</html>