<div class="acto @if($attributes['data']->isFinished) acto-finished @endif">
    <div class="acto-summary">
        <div class="acto-status-container">
            <x-acto-status :status="$attributes['data']->status" :idActo="$attributes['data']->id_acto" :idPersona="$attributes['idPersona']" :isFinished="$attributes['data']->isFinished"/>
        </div>  
        <div class="acto-date">
            <p><strong>Fecha: </strong>{{ $attributes['data']->fecha}}</p>
            <p><strong>Hora: </strong>{{ $attributes['data']->hora}}</p>
        </div>
        <div class="acto-title">
            <h1>{{ $attributes['data']->titulo}}</h1>
        </div>
        <div class="acto-details">
            <p class="grid-item">{{ $attributes['data']->descripcion}}</p>
            <p class="grid-item">{{ $attributes['data']->totalInscritos}} / {{ $attributes['data']->num_asistentes}}</p>
        </div>
    </div>
    <div class="acto-description">
        <div>
            <p><strong>{{ $attributes['data']->descripcion_corta}}</strong></p>
            <p>{{ $attributes['data']->descripcion_larga}}</p>
        </div>
        @if($attributes['idPersona'] !== null && $attributes['data']->status !== "ponente" && $attributes['data']->isFinished === false)
            <x-ActoSubscriptionButton :inscritos="$attributes['data']->totalInscritos" :capacity="$attributes['data']->num_asistentes" :status="$attributes['data']->status" :idActo="$attributes['data']->id_acto" :idPersona="$attributes['idPersona']" :id_inscripcion="$attributes['data']->id_inscripcion ?? null"/>
        @endif
        @if($attributes['idPersona'] === null)
            <a href="{{ route('iniciar-sesion') }}" class="primary-button anchor">
                Conectarse                            
            </a>
        @endif
    </div>
    @if($attributes['data']->status === 'ponente' && $attributes['data']->isFinished)
        <div class='ponente-container'>
            <form class="file_upload" method="post" action="{{ route('addFile.post') }}" enctype="multipart/form-data">
                @csrf
                <div class="content_form">
                    <!-- <label for="archivo">Subir archivo:</label> -->
                    <input type="file" name="archivo[]" multiple>
                    <input type="hidden" name="id_acto" value="{{ $attributes['data']->id_acto }}">
                    <input type="hidden" name="id_persona" value="{{ $attributes['idPersona'] }}">
                </div>
                <button class="primary-button" type="submit" archivo">Subir Archivos</button>
            </form>
            <button onclick="openPopup({{ $attributes['data']->id_acto }})" class="primary-button handle-files">Modificar documentación</button>
        </div>
        <div id="info_{{ strval($attributes['data']->id_acto) }}" class="acto-list-popup">
            <div class="info_acto-list-popup">
                <div class="info">
                    @if(count($attributes['data']->documentos) > 0)
                    <label>Modificar orden:</label>
                    <ul class="draggable-container_{{ strval($attributes['data']->id_acto) }} draggable-container">
                        @foreach($attributes['data']->documentos as $archivo)
                            <li id="{{ $archivo->id_presentacion }}" class="draggable_{{ strval($attributes['data']->id_acto) }} draggable" draggable="true">
                                <strong>{{ $archivo->titulo_documento }}</strong>
                            </li>
                        @endforeach
                    </ul>
                    @endif
                </div>
                <button onClick="updateActoFiles({{ $attributes['data']->id_acto }})" class="primary-button">Actualizar</button>
            </div>
            <span class="acto-list-popup-close" onclick="closePopup({{ $attributes['data']->id_acto }})">x</span>
        </div>
    @endif
    @if(count($attributes['data']->documentos) > 0 && $attributes['idPersona'] !== null)
        <details class="acto-files">
            <summary>Archivos disponibles:</summary>
            <ul>
                @foreach($attributes['data']->documentos as $archivo)
                    <li>
                        <strong>{{ $archivo->titulo_documento }}</strong>
                    </li>
                @endforeach
            </ul>
        </details>
    @endif
    @if($attributes['idPersona'] === null)
        <p>Debes estar conectado para poder ver los documentos del acto</p>
    @endif
</div>
<script> //PopUp and drag and drop functionality
    function openPopup(id) {
        var popupBackground = document.getElementById('popup-background');
        let draggables = document.querySelectorAll('.draggable_' + id)
        const container = document.querySelector('.draggable-container_' + id)
        popupBackground.style.display = 'flex';

        var popup = document.getElementById('info_' + id);
        popup.style.display = 'flex';
    
        draggables.forEach(draggable => {
            draggable.addEventListener('dragstart', () => {
                draggable.classList.add('dragging')
            })

            draggable.addEventListener('dragend', () => {
                draggable.classList.remove('dragging')
            })
        })

        container.addEventListener('dragover', e => {
            e.preventDefault()
            const afterElement = getDragAfterElement(draggables, e.clientY)
            const draggingElement = document.querySelector('.dragging')
            if (afterElement == null) {
                container.appendChild(draggingElement)
            } else {
                container.insertBefore(draggingElement, afterElement)
            }
        })
    }

    function getDragAfterElement(draggables, y) {
        const draggableElements = [...draggables].filter(draggable => {
            return !draggable.className.includes("dragging")
        })

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

    function closePopup(id) {
            var popupBackground = document.getElementById('popup-background');
            popupBackground.style.display = 'none';
    
            var popup = document.getElementById('info_' + id);
            popup.style.display = 'none';
        }
</script>
<script>
    function updateActoFiles(id) {
        const draggableElements = document.querySelectorAll(`.draggable_${id}`)
        const formData = {
            documentos: [...draggableElements].map((element, index) => {
                return {
                        id_presentacion: element.id,
                        orden: index,
                    }
            })      
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
@include('common/footer')