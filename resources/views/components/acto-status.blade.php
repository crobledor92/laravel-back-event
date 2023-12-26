@if($attributes['status'] === 'ponente')
    <div class="acto-status--ponente">
        <p class="grid-item">{{ $attributes['status']  }}</p>
    </div>
@elseif ($attributes['status'] === 'inscrito')
    <div class="acto-status--inscrito">
        <p class="grid-item">{{ $attributes['status']  }}</p>
    </div>
@else 
    <div class="acto-status--noInscrito">
        <p class="grid-item">No inscrito</p>
    </div>
@endif