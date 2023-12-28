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
        <style>
            .filter div{display:flex;align-items:center;margin:5px 0px 25px;}
            .filter .filter_text{font-weight:bold;}
            .filter label{display:flex;align-items:center;margin-right:15px;margin-bottom:0px;font-weight:normal;}
            .filter span{margin-right:15px;}
            .filter label::after{content:'';margin-left:15px;border-left:1px solid #000;height:12px;}
            .filter label:last-child::after{content:none;}
            .filter label input{width:auto;margin:0;}
            .file_upload{margin:10px 0px;display:flex;gap:20px;justify-content:space-between;}
            .file_upload .submit{width:200px;margin:0;}
            .file_upload summary{cursor:pointer;}
            .file_upload .content_form{display:flex;width:-webkit-fill-available;align-items:center;}
            .file_upload label{width:-webkit-fill-available;max-width:max-content;margin:0;}
            .file_upload input[type="file"]{margin:0 0 0 10px;}
        </style>
        <section class="filter">
            <span class="filter_text">Filtro: </span>
            <div>
                <label>
                    <span>No inscritos: </span><input type="checkbox" id="checkboxNoInscritos" checked>
                </label>
                <label>
                    <span>Inscritos: </span><input type="checkbox" id="checkboxInscritos" checked>
                </label>
                <label>
                    <span>Ponente: </span><input type="checkbox" id="checkboxPonente" checked>
                </label>                
            </div>
        </section>
        <section class="actos-list">
            {!! $listadoActosHTML !!}
        </section>       
    </div>
</main>
<script>
    const checkboxInscritos = document.getElementById('checkboxInscritos');
    const checkboxNoInscritos = document.getElementById('checkboxNoInscritos');
    const checkboxPonente = document.getElementById('checkboxPonente');
    function actualizarVisualizacion() {
        const actos = document.querySelectorAll('.acto');
        actos.forEach(acto => {
            const esInscrito = acto.classList.contains('inscrito');
            const esNoInscrito = acto.classList.contains('noinscrito');
            const esPonente = acto.classList.contains('ponente');
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