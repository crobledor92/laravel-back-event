@include('common/session')
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar perfil - Back Event</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="icon" href="img/favicon.ico" type="image/x-icon">
</head>
<body>
@include('common/navegation')
<main>
    <form class="form-box" action="{{ route('update.post') }}" method="post">
        @csrf
        <fieldset> 
            <legend>Actualiza tus datos:</legend>
            <label for="username">Nombre de usuario:</label>
            <input type="text" name="username" value="{{ $userInfo->username }}"><br>
            <label for="email">Correo electronico:</label>
            <input type="text" name="email" value="{{ $userInfo->email }}"><br>
            <label for="password">Contraseña actual:</label>
            <input type="password" name="old_password"><br>           
            <label for="password">Nueva contraseña:</label>
            <input type="password" name="new_password"><br>
            <label for="passwordRepeat">Repite la nueva contraseña:</label>
            <input type="password" name="new_passwordRepeat"><br>
            <input type="submit" value="Actualizar perfil">
        </fieldset>        
    </form>
</main>
@include('common/footer')