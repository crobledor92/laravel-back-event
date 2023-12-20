@include('common/session')
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro - Back Event</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="icon" href="img/favicon.ico" type="image/x-icon">
</head>
<body>
@include('common/navegation')
<main>
    <div class="container">
        <form method="post" action="{{ route('register.post') }}" class="form-box">
            @csrf
            <fieldset>
                <legend>Nuevo Registro:</legend>
                <label>Nombre</label>
                <input type="text" name="nombre"><br>
                <label>Primer apellido</label>
                <input type="text" name="apellido1"><br>
                <label>Segundo apellido</label>
                <input type="text" name="apellido2"><br>
                <label>Tipo de usuario</label>
                <select name="user_type">
                    <option value="usuario">Usuario</option>
                    <option value="ponente">Ponente</option>
                    <option value="administrador">Administrador</option>
                </select>
                <label>Email</label>
                <input type="text" name="email"><br>
                <label>Usuario</label>
                <input type="text" name="username"><br>
                <label>Contraseña</label>
                <input type="password" name="password"><br>
                <label>Repite la contraseña</label>
                <input type="password" name="passwordRepeat"><br>
                <input type="submit" name="register" value="Registrarse"><br>
            </fieldset>
        </form>        
    </div>
</main>
@include('common/footer')