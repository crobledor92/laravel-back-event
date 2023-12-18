<div id="acto-modal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeModal()">&times;</span>
        <h2 id="titulo"></h2>
        <p>Fecha: <span id="fecha"></span></p>
        <p>Resumen: <span id="resumen"></span></p>
        <p>Descripción: <span id="descripcion"></span></p>
        <p>Ponentes:</p>
        <div id="ponentes">
        </div>
    </div>
</div>
<script>
    function openModal(actoId) {
        const actos = <?= json_encode($_SESSION['actos']) ?>;
        const ponentes = <?= json_encode($_SESSION['listaPonentes']) ?>;
        const selectedActo = actos.find(function(acto) {
            return Number(acto.Id_acto) === actoId;
        });

        document.getElementById('titulo').innerText = selectedActo.Titulo;
        document.getElementById('fecha').innerText = `${selectedActo.Fecha} - ${selectedActo.Hora}`;
        document.getElementById('resumen').innerText = selectedActo.Descripcion_corta;
        document.getElementById('descripcion').innerText = selectedActo.Descripcion_larga;

        if (ponentes !== null) {
            const selectedPonentes = ponentes.filter(ponente => Number(ponente.ID_Acto) === actoId);
            document.getElementById('ponentes').innerHTML = '';
            selectedPonentes.forEach(ponente => {
                const ponenteHTML = document.createElement('p');
                ponenteHTML.innerText = `${ponente.NombreCompleto}`;
                document.getElementById('ponentes').appendChild(ponenteHTML);
            })
        } else {
            document.getElementById('ponentes')
            const ponenteHTML = document.createElement('p');
            ponenteHTML.innerText = "No hay ponentes programados";
            document.getElementById('ponentes').appendChild(ponenteHTML);
        }

        document.getElementById('acto-modal').style.display = 'block';
    }

    function closeModal() {
        document.getElementById('acto-modal').style.display = 'none';
    }

    window.onclick = function(event) {
        var modal = document.getElementById('acto-modal');
        if (event.target == modal) {
            modal.style.display = 'none';
        }
    }
</script>
<style>
    .modal {
        display: none;
        position: fixed;
        z-index: 1;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        overflow: auto;
        background-color: rgba(0, 0, 0, 0.7);
    }
    
    /* Style for the modal content */
    .modal-content {
        border-radius: 5px;
        background-color: #fefefe;
        margin: 15% auto;
        padding: 20px;
        border: 1px solid #888;
        width: 80%;
    }

    /* Close button style */
    .close {
        color: #aaa;
        float: right;
        font-size: 28px;
        font-weight: bold;
        cursor: pointer;
    }
</style>