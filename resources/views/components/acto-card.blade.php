<div class="acto">
    <div class="acto-summary">
        <x-acto-status :status="$attributes['data']->status" :idActo="$attributes['data']->id_acto" :idPersona="$attributes['idPersona']"/>
        <div class="acto-date">
            <p><strong>Fecha: </strong>{{ $attributes['data']->fecha}}</p>
            <p><strong>Hora: </strong>{{ $attributes['data']->hora}}</p>
        </div>
        <div class="acto-title">
            <p>{{ $attributes['data']->titulo}}</p>
        </div>
        <div class="acto-details">
            <p class="grid-item">{{ $attributes['data']->descripcion}}</p>
            <p class="grid-item">{{ $attributes['data']->totalInscritos}} / {{ $attributes['data']->num_asistentes}}</p>
        </div>
    </div>
    <!-- <input type="file" name="archivo" required> -->
    <div class="acto-description">
        <p>{{ $attributes['data']->descripcion_corta}}</p>
        @if($attributes['data']->status !== "ponente")
            <x-ActoSubscriptionButton :inscritos="$attributes['data']->totalInscritos" :capacity="$attributes['data']->num_asistentes" :status="$attributes['data']->status" :idActo="$attributes['data']->id_acto" :idPersona="$attributes['idPersona']" :id_inscripcion="$attributes['data']->id_inscripcion ?? null"/>
        @endif
    </div>
    @if($attributes['data']->status === 'ponente' && $attributes['data']->isFinished)
    <form class="file_upload" method="post" action="{{ route('addFile.post') }}" enctype="multipart/form-data">
        @csrf
        <div class="content_form">
            <label for="archivo">Subir archivo:</label>
            <input type="file" name="archivo">
            <input type="hidden" name="id_acto" value="{{ $attributes['data']->id_acto }}">
            <input type="hidden" name="id_persona" value="{{ $attributes['idPersona'] }}">
        </div>
        <input class="submit" type="submit" value="Subir archivo">
    </form>
    @endif
    @if(count($attributes['data']->documentos) > 0)
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
</div>