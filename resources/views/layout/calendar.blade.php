<div id="calendar" class="calendar"></div>
<div id="eventos"></div>
<script>
var mesActual, anioActual, actos, div_info;
document.addEventListener('DOMContentLoaded', function () {
    mesActual = new Date().getMonth() + 1;
    anioActual = new Date().getFullYear();
    generarCalendarioConActos(mesActual, anioActual);
});
function generarCalendarioConActos(mes, anio) {
    var actos = {!! $actos !!};
    var inscripciones = {!! $inscripciones !!};
    var ponencias = {!! $ponencias !!};
    var primerDia = new Date(anio, mes - 1, 1);
    var ultimoDia = new Date(anio, mes, 0);
    var diaActual = new Date(primerDia);
    var celdas = 0;
    var diasEnMes = ultimoDia.getDate();
    var primerDiaSemana = (primerDia.getDay() + 6) % 7;
    var eventos = "";
    var calendarHtml = '<div class="table"><div class="caption"><button onclick="mesAnterior()">Mes Anterior</button><span>' + new Intl.DateTimeFormat('es', { month: 'long', year: 'numeric' }).format(diaActual).toLocaleUpperCase() + '</span><button onclick="mesSiguiente()">Mes Siguiente</button></div>';
    calendarHtml += '<table border="1"><tr><th>Lunes</th><th>Martes</th><th>Miércoles</th><th>Jueves</th><th>Viernes</th><th>Sábado</th><th>Domingo</th></tr><tr>'; 
    for (var i = 0; i < primerDiaSemana; i++) {
        calendarHtml += '<td></td>';
    }
    for (var dia = 1; dia <= diasEnMes; dia++) {
        calendarHtml += '<td>';
        calendarHtml += '<div class="dia">' + dia + '</div>';
        var eventosDelDia = actos.filter(function(acto) {
            var fechaActo = new Date(acto.fecha);
            return fechaActo.getDate() === dia && fechaActo.getMonth() + 1 === mes && fechaActo.getFullYear() === anio;
        });
        if (eventosDelDia.length > 0) {
            calendarHtml += '<ul>';
            eventosDelDia.forEach(function(evento) {
                var isAlistada = inscripciones.some(function(inscripcion) {
                return inscripcion.id_acto === evento.id_acto;
            });
            var isPonente = ponencias.some(function(ponencia) {
                return ponencia.id_acto === evento.id_acto;
            });
            var color = isAlistada ? (isPonente ? 'speaker' : 'ins') : (isPonente ? 'speaker' : 'noins');
            var buttonHandle = isPonente ? 'ERES PONENTE' : (isAlistada ? 'NO VOY A ASISTIR' : 'ASISTIR');
            var blockingbutton = isPonente ? 'disabled': '';
            buttonHandle = '<button class="' + color + '" onclick="handleEvent(\'' + evento.id_acto + '\')" ' + blockingbutton + '>' + buttonHandle + '</button>';
            calendarHtml += '<li class="' + color + '"><span class="titulo">' + evento.titulo + '</span><button onclick="openPopup(\'' + evento.id_acto + '\')" class="more">+</button></li>';
            eventos += '<div id="info_' + evento.id_acto + '" class="popup"><div class="back"></div><div class="info_popup"><div class="info"><p><b>Titulo del evento:</b> '+ evento.titulo +'</p><p><b>Descripcion corta:</b> '+ evento.descripcion_corta +'</p><p><b>Descripcion larga:</b> '+ evento.descripcion_larga +'</p><p><b>Numero de asistentes:</b> '+ evento.num_asistentes +'</p><p><b>Fecha del evento:</b> '+ evento.fecha +'</p><p><b>Hora del evento:</b> '+ evento.hora +'</p></div><div>' + buttonHandle + '</div></div><span class="close" onclick="closePopup(\'info_' + evento.id_acto + '\')">x</span></div>';
            });
            calendarHtml += '</ul>';
        }
        calendarHtml += '</td>';
        if (diaActual.getDay() === 0 && dia !== diasEnMes) {
            celdas = 0;
            calendarHtml += '</tr><tr>';
        }
        diaActual.setDate(diaActual.getDate() + 1);
        celdas++;
    }
    while (celdas <= 7) {
        calendarHtml += '<td></td>';
        celdas++;
    }
    calendarHtml += '</tr></table></div>';
    document.getElementById('calendar').innerHTML = calendarHtml;
    document.getElementById('eventos').innerHTML = eventos;
}

function mesAnterior() {
    mesActual--;
    if (mesActual < 1) {
        mesActual = 12;
        anioActual--;
    }
    generarCalendarioConActos(mesActual, anioActual);
}
function mesSiguiente() {
    mesActual++;
    if (mesActual > 12) {
        mesActual = 1;
        anioActual++;
    }
    generarCalendarioConActos(mesActual, anioActual);
}
function openPopup(id) {
    var popup = document.getElementById('info_' + id);
    popup.style.display = 'flex';
}
function closePopup(id) {
    var popup = document.getElementById(id);
    popup.style.display = 'none';
}
</script>