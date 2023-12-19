<?php
use Illuminate\Support\Facades\Session;

$userInfo = Session::get('userInfo', null);
$actos = Session::get('actos', null);
$listaInscripcionesActos = Session::get('listaInscripcionesActos', null);
$listaTiposActos = Session::get('listaTiposActos', null);
$personas = Session::get('personas', null);