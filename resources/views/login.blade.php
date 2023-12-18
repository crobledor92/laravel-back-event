@include('common/session')
@if(isset($logout) && $logout)
    Crear funcion para cerrar serion
@endif
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar sesión - Back Event</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="icon" href="img/favicon.ico" type="image/x-icon">
</head>
<body>
    @include('common/navegation')
    <main>
        @if(isset($logout) && $logout)
            <p>Crear funcion para cerrar serion</p>
        @endif
        <div class="login-container">
            <form class="form-box" action="controller/login2_controller.php" method="post">
                <fieldset>
                    <legend>Inicia Sesion:</legend>
                    <label for="username">Usuario</label>
                    <input type="text" name="username" required><br>
                    <label for="password">Contraseña</label>
                    <input type="password" name="password" required><br>
                    <input type="submit" name="login" value="Iniciar Sesión"><br>
                </fieldset>
            </form>
        </div>
    </main>
</body>
</html>