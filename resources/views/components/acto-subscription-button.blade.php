@if($attributes['status'] === 'noInscrito')
    @if($attributes['inscritos'] < $attributes['capacity'])
        <form method="post" action="{{ route('add-inscrito.post', ['id_acto' => $attributes['idActo'], 'id_persona' => $attributes['idPersona'], 'userSubscription' => true ]) }}">
        @csrf
            <button type="submit" class="secondary-button subscribe-button">Inscribirse</button>
        </form>
    @else
        <div>
            <button type="submit" class="completed-button" disabled>Completo</button>
        </div> 
    @endif
@else
    <form method="post" action="{{ route('delete-inscrito.delete', ['id_acto' => $attributes['idActo'], 'id_inscripcion' => $attributes['id_inscripcion'], 'userSubscription' => true ]) }}">
    @csrf
    @method('delete')
        <button type="submit" class="secondary-button unsubscribe-button">Desincribirse</button>
    </form>
@endif