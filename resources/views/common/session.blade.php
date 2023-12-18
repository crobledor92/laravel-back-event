@php
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    $userInfo = session('userInfo', '');
    $actos = session('actos', '');
    $listaInscripcionesActos = session('listaInscripcionesActos', '');
    $listaTiposActos = session('listaTiposActos', '');
    $personas = session('personas', '');
@endphp