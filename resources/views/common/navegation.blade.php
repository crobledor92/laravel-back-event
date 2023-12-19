<header>
    <div class="container">
        <a href="{{ route('landing') }}" class="logo"><img src="img/logo.svg" alt="BackEvent" title="Pagina Principal - Back Event"style="width:auto;height:50px;"></a>
        <nav class="right">
        @if ($userInfo !== null)
            @if($userInfo->Id_tipo_usuario == 3)
            <a href="{{ route('admin-panel') }}">Panel de administrador</a>
            @endif
            @if(request()->is('view/homepage_view.php'))
            <a href="{{ route('edit-profile') }}">Editar Perfil</a>
            @else
            <a href="{{ route('personal-panel') }}">Mi Perfil</a>
            @endif 
            <a href="{{ route('logout') }}">Salir</a>
        @else
            <a href="{{ route('login') }}">Iniciar sesión</a>
            <a href="{{ route('register') }}">Regístrate</a>
        @endif        
        </nav>
    </div>
</header>