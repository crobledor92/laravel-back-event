<style>
.calendar table{
    width: 100%;
    border-collapse: collapse;
}
.calendar .caption{
    font-size: 1.5em;
    background: #bacad4;
    padding: 10px;
    font-weight: bold;
    display:flex;
    justify-content: space-between;
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
<div id="calendar" class="calendar"></div>
<script>
    var mesActual, anioActual;
    document.addEventListener('DOMContentLoaded', function () {
        mesActual = new Date().getMonth() + 1;
        anioActual = new Date().getFullYear();
        generarCalendarioConActos(mesActual, anioActual);
    });
    function generarCalendarioConActos(mes, anio, eventos) {
        var primerDia = new Date(anio, mes - 1, 1);
        var ultimoDia = new Date(anio, mes, 0);
        var diaActual = new Date(primerDia);
        var celdas = 0;
        var diasEnMes = ultimoDia.getDate();
        var primerDiaSemana = (primerDia.getDay() + 6) % 7;
        var calendarHtml = '<div class="caption"><button onclick="mesAnterior()">Mes Anterior</button><span>' + new Intl.DateTimeFormat('es', { month: 'long', year: 'numeric' }).format(diaActual).toLocaleUpperCase() + '</span><button onclick="mesSiguiente()">Mes Siguiente</button></div>';
        calendarHtml += '<table border="1"><tr><th>Lunes</th><th>Martes</th><th>Miércoles</th><th>Jueves</th><th>Viernes</th><th>Sábado</th><th>Domingo</th></tr><tr>';
        for (var i = 0; i < primerDiaSemana; i++) {
            calendarHtml += '<td></td>';
        }
        for (var dia = 1; dia <= diasEnMes; dia++) {
            calendarHtml += '<td>';
            calendarHtml += '<div class="dia">' + dia + '</div>';
            //Funcion para actos
            calendarHtml += '</td>';
            if (diaActual.getDay() === 0 && dia !== diasEnMes) {
                celdas=0;
                calendarHtml += '</tr><tr>';
            }
            diaActual.setDate(diaActual.getDate() + 1);
            celdas++;
        }
        while (celdas <= 7) {
            calendarHtml += '<td></td>';
            celdas++;
        }
        calendarHtml += '</tr></table>';
        document.getElementById('calendar').innerHTML = calendarHtml;
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
</script>