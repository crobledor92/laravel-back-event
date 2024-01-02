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
    <section class="container">
        <div class='ponente-container'>
            <form class="file_upload" method="post" action="{{ route('addFile.post') }}" enctype="multipart/form-data">
                @csrf
                <div class="content_form">
                    <input type="file" name="archivo[]" multiple>
                    <input type="hidden" name="id_acto" value="{{ $idActo }}">
                    <input type="hidden" name="id_persona" value="{{ $idPersona }}">
                </div>
                <button class="primary-button" type="submit" archivo">Subir Archivos</button>
            </form>
        </div>
        <div class="info_acto-list-popup">
            <div class="info">
                @if(count($documentos) > 0)
                <label>Modificar orden:</label>
                <ul class="draggable-container">
                    @foreach($documentos as $documento)
                        <li id="{{ $documento->id_presentacion }}" class="draggable" draggable="true">
                            <strong>{{ $documento->titulo_documento }}</strong>
                        </li>
                    @endforeach
                </ul>
                @endif
            </div>
            <button onClick="updateActoFiles({{ $idActo }})" class="primary-button">Actualizar</button>
        </div>
    </section>
    <script>
        function updateActoFiles(id) {
            const draggableElements = document.querySelectorAll(`.draggable`)
            const formData = {
                documentos: [...draggableElements].map((element, index) => {
                    return {
                            id_presentacion: element.id,
                            orden: index,
                        }
                }),
                fromAdminPanel: true,       
            }
    
            fetch("{!! route('updateFilesOrder.post') !!}", {
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
    
            })
            .catch((error) => {
                console.error('Error:', error);
            })
            .finally(() => {
                positionScroll();
                setTimeout(function() {
                    location.reload();
                }, 200);
            });
        }
    </script>
    <script>
        const draggables = document.querySelectorAll('.draggable')
        const container = document.querySelector('.draggable-container')

        console.log("draggables", draggables)
        console.log("container", container)
    
        draggables.forEach(draggable => {
            draggable.addEventListener('dragstart', () => {
                console.log("start dragging")
                draggable.classList.add('dragging')
            })

            draggable.addEventListener('dragend', () => {
                console.log("end dragging")
                draggable.classList.remove('dragging')
            })
        })

        container.addEventListener('dragover', e => {
            e.preventDefault()
            const afterElement = getDragAfterElement(container, e.clientY)
            const draggingElement = document.querySelector('.dragging')
            console.log("after element", afterElement)
            if (afterElement == null) {
                container.appendChild(draggingElement)
            } else {
                container.insertBefore(draggingElement, afterElement)
            }
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
    @include('common/footer')
