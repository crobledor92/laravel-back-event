@include('common/session')
<!DOCTYPE html>
<html lang="es">
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
    <div class="container">
        <form class="form-box" action="{{ route('login.post') }}" method="post">
            @csrf
            <fieldset>
                <legend>Inicia Sesion:</legend>
                <label for="username">Usuario</label>
                <input type="text" name="username"><br>
                <label for="password">Contraseña</label>
                <input type="password" name="password"><br>
                <input type="submit" name="login" value="Iniciar Sesión"><br>
            </fieldset>
        </form>       
    </div>
</main>
@include('common/footer')