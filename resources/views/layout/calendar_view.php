<h2>Calendario de Actos</h2>
<?php
include('../view/modal_view.php');
function generarCalendarioConActos($mes, $anio, $actos,$userInfo, $listaInscripciones) {
    $primerDia = strtotime("first day of $anio-$mes");
    $ultimoDia = strtotime("last day of $anio-$mes");
    $diaActual = $primerDia;
    $diasEnMes = date('t', $diaActual);
    $primerDiaSemana = date('N', $diaActual);
    echo '<table class="calendar" border="1">';
    echo '<caption>' . date('F Y', $diaActual) . '</caption>';
    echo '<tr>';
    echo '<th>Lunes</th><th>Martes</th><th>Miércoles</th><th>Jueves</th><th>Viernes</th><th>Sábado</th><th>Domingo</th>';
    echo '</tr><tr>';
    for ($i = 1; $i < $primerDiaSemana; $i++) {
        echo '<td></td>';
    }
    for ($dia = 1; $dia <= $diasEnMes; $dia++) {
        echo '<td>';
        echo '<div class="dia">' . $dia . '</div>';
        foreach ($actos as $acto) {
            $fechaActo = strtotime($acto->Fecha);
            if (date('j', $fechaActo) == $dia) {
                if(usuarioEsPonente($userInfo->Id_Persona, $acto->Id_acto)){
                    echo '<div class="event speaker">
                            <span>' . date('H:i', strtotime($acto->Hora)) . ' - ' . $acto->Titulo . '</span>
                            <button onclick="openModal('. $acto->Id_acto .')">+</button>
                        </div>';
                } else {
                    $usuarioAsiste = usuarioAsiste($userInfo->Id_Persona, $acto->Id_acto, $listaInscripciones);
                    if ($usuarioAsiste == 1) {
                        echo '<div class="event ins"><span>' . date('H:i', strtotime($acto->Hora)) . ' - ' . $acto->Titulo . '</span>';
                        echo '<button class="btn-no-inscribir" data-id-acto="' . $acto->Id_acto . '">No Asistir</button>
                                <button onclick="openModal('. $acto->Id_acto .')">+</button>
                                </div>';
                    } else {
                        echo '<div class="event noins"><span>' . date('H:i', strtotime($acto->Hora)) . ' - ' . $acto->Titulo . '</span>';
                        echo '<button class="btn-inscribir" data-id-acto="' . $acto->Id_acto . '">Asistir</button>
                            <button onclick="openModal('. $acto->Id_acto .')">+</button>
                        </div>';
                    }              
                    echo '<br>';
                }
            }
        }
        echo '</td>';
        if (date('N', $diaActual) == 7) {
            echo '</tr><tr>';
        }
        $diaActual = strtotime('+1 day', $diaActual);
    }
    while (date('N', $diaActual) > 1) {
        echo '<td></td>';
        $diaActual = strtotime('+1 day', $diaActual);
    }
    echo '</tr></table>';
}
$mesActual = date('m');
$anioActual = date('Y');
function usuarioAsiste($persona, $acto, $inscripciones) {
    foreach ($inscripciones as $inscripcion) {
        if ($inscripcion->Id_persona == $persona && $inscripcion->id_acto == $acto) {
            return 1;
        }
    }
    return 0;
}
function usuarioEsPonente($personaId, $actoId) {
    $ponentes = $_SESSION['listaPonentes'];
    if ($ponentes != NULL && count($ponentes) > 0) {
        foreach($ponentes as $ponente) {
            if ($ponente->ID_Acto == $actoId && $ponente->ID_Persona == $personaId) {
                return true;
            }
        }
        return false;
    } 
        return false;
}
generarCalendarioConActos($mesActual,$anioActual,$listaActos,$userInfo,$listaInscripcionesActos);
?>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        var buttons_inscribir = document.querySelectorAll('.btn-inscribir');
        buttons_inscribir.forEach(function (button) {
            button.addEventListener('click', function () {
                var idActo = this.getAttribute('data-id-acto');
                fetch('controller/inscription_controller.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                    },
                    body: 'id_acto=' + encodeURIComponent(idActo) + '&Asistir=1' + '&Id_persona=<?=$userInfo->Id_Persona?>',
                })
                .then(response => response.text())
                .catch(error => {
                    console.error('Error:', error);
                });
                setTimeout(function(){ location.reload(); }, 200);
            });
        });
        var buttons_noinscribir = document.querySelectorAll('.btn-no-inscribir');
        buttons_noinscribir.forEach(function (button) {
            button.addEventListener('click', function () {
                var idActo = this.getAttribute('data-id-acto');
                fetch('controller/inscription_controller.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                    },
                    body: 'id_acto=' + encodeURIComponent(idActo) + '&noAsistir=1' + '&Id_persona=<?=$userInfo->Id_Persona?>',
                })
                .then(response => response.text())
                .catch(error => {
                    console.error('Error:', error);
                });
                setTimeout(function(){ location.reload(); }, 200);
            });
        });
    });
</script>
<style>
        table.calendar{
        width: 100%;
        border-collapse: collapse;
        margin: 20px 0;
    }
    .calendar caption{
        font-size: 1.5em;
        background: #bacad4;
        padding: 10px;
        font-weight: bold;
    }
    .calendar th, .calendar td{
        border: 1px solid #ddd;
        text-align: center;
        padding: 10px;
    }
    .calendar th{
        background-color: #f2f2f2;
    }
    .calendar td{
        width: 100px;
        height: 100px;
        vertical-align: top;
    }
    .calendar .dia{
        padding: 4px;
        background: #c9e4ee;
        border-radius: 5px;
    }
    .calendar .event{
        margin: 5px auto 0;
        border-radius: 5px;
    }
    .calendar button{
        background: #ffffff80;
        border: 1px solid;
        border-radius: 5px;
        cursor: pointer;
    }
    .calendar .ins{
        background: #8eff8e;
        padding: 2px;
        display: flex;
        justify-content: space-between;
    }
    .calendar .noins{
        background: #ff7474;
        padding: 2px;
        display: flex;
        justify-content: space-between;
    }
    .calendar .speaker{
        background: #ffae00;
        padding: 2px;
        display: flex;
        justify-content: space-between;
    }
    </style>
