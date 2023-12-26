<div class="acto">
    <div class="acto-summary">
        <div class="acto-date">
            <p>{{ $attributes['data']->fecha}}</p>
            <p>{{ $attributes['data']->hora}}</p>
        </div>
        <div class="acto-title">
            <p>{{ $attributes['data']->titulo}}</p>
        </div>
        <div class="acto-details">
            <x-acto-status :status="$attributes['data']->status"/>
            <p class="grid-item">{{ $attributes['data']->descripcion}}</p>
            <p class="grid-item">{{ $attributes['data']->totalInscritos}} / {{ $attributes['data']->num_asistentes}}</p>
        </div>
    </div>
    <input type="file" name="archivo" required>
    <div class="acto-description">
        <p>{{ $attributes['data']->descripcion_corta}}</p>
    </div>
</div>