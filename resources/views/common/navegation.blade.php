<header>
    <a href="{{ route('landing') }}" class="logo"><img src="img/logo.svg" alt="BackEvent" title="Pagina Principal - Back Event"style="width:auto;height:50px;"></a>
    <nav class="right">
        <a href="{{ route('admin-panel') }}">Panel de administrador</a>
        <a href="{{ route('edit-profile') }}">Editar Perfil</a>
        <a href="{{ route('personal-panel') }}">Mi Perfil</a>
        <a href="{{ route('logout') }}">Salir</a>
        <a href="{{ route('login') }}">Iniciar sesión</a>
        <a href="{{ route('register') }}">Regístrate</a>
    </nav>
</header>