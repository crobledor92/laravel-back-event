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
        <section class='container container-ponentes'>
            <h2 class='ponentes-title'>Ajustes de ponentes:</h2>
            <div class='ponentes-section'>
                <div class="personas">
                    <h1>Personas</h1>
                    <ul class="draggable-container">
                        @foreach($personas as $persona)
                        <li id="{{ $persona->id_persona }}" class="draggable" draggable="true">
                            <strong>{{ $persona->nombre }} {{ $persona->apellido1 }} {{ $persona->apellido2 }}</strong>
                        </li>
                        @endforeach
                    </ul>
                </div>
                <div class="ponentes">
                    <h1>Ponentes</h1>
                    <ul class="draggable-container ponentes-container">
                        @foreach($ponentes as $index => $ponente)
                        <li id="{{ $ponente->id_persona }}" class="draggable" draggable="true">
                            <strong>{{ $index + 1 }} - {{ $ponente->nombre }} {{ $ponente->apellido1 }} {{ $ponente->apellido2 }}</strong>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div> 
            <button onClick="updateActoPonentesOrden({{ $idActo }})" class="primary-button">Actualizar</button>
        </section> 
    </main>
    <script>
        const draggables = document.querySelectorAll('.draggable')
        const containers = document.querySelectorAll('.draggable-container')

        draggables.forEach(draggable => {
            draggable.addEventListener('dragstart', () => {
                draggable.classList.add('dragging')
            })

            draggable.addEventListener('dragend', () => {
                draggable.classList.remove('dragging')
            })
        })

        containers.forEach(container => {
            container.addEventListener('dragover', e => {
                e.preventDefault()
                const afterElement = getDragAfterElement(container, e.clientY)
                const draggingElement = document.querySelector('.dragging')
                if (afterElement == null) {
                    container.appendChild(draggingElement)
                } else {
                    container.insertBefore(draggingElement, afterElement)
                }
            })
        })

        function getDragAfterElement(container, y) {
            const draggableElements = [...container.querySelectorAll('.draggable:not(.dragging)')]

            return draggableElements.reduce((closest, child) => {
                const box = child.getBoundingClientRect()
                const offset = y - box.top - box.height / 2

                if (offset < 0 && offset > closest.offset) {
                    return { offset: offset, element: child }
                } else {
                    return closest
                }
            }, { offset: Number.NEGATIVE_INFINITY }).element
        }
    </script>
    <script>
        function updateActoPonentesOrden(idActo) {
            const container = document.querySelector(`.ponentes-container`)
            const ponentes = container.querySelectorAll('.draggable')
            console.log(ponentes)
            
            const formData = {
                ponentesData: [...ponentes].map((element, index) => {
                    return {
                            id_persona: element.id,
                            orden: index,
                        }
                }),
                idActo     
            } 

            fetch("{!! route('updatePonentes.post') !!}", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{!! csrf_token() !!}',
            },
            body: JSON.stringify(formData),
            })
            .then(response => response.json())
            .then(data => {
                console.log('Success:', data);
                location.reload();
            })
            .catch((error) => {
                console.error('Error:', error);
            });

        }
    </script>
</main>
@include('common/footer')

