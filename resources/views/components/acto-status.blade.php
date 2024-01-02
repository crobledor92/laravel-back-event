
    @if($attributes['status'] === 'ponente' && $attributes['idPersona'] !== null)
        <div class="acto-status acto-status--ponente">
            <p class="grid-item">{{ $attributes['status']  }}</p>
        </div>
    @elseif($attributes['status'] === 'inscrito' && $attributes['idPersona'] !== null)
        <div class="acto-status acto-status--inscrito">
            <p class="grid-item">{{ $attributes['status']  }}</p>
        </div>
    @elseif($attributes['idPersona'] !== null)
        <div class="acto-status acto-status--noInscrito">
            <p class="grid-item">No inscrito</p>
        </div>
    @endif