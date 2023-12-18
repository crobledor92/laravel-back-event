@include('common/session')
<!DOCTYPE html>
<html lang="en">
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
        <form class="update" action="controller/updateUser_controller.php"  method="post">
            <fieldset>
                <legend>Actualiza tus datos:</legend>
                <label for="username">Nombre de usuario:</label>
                <input type="text" name="username" value="<?=$userInfo->Username?>" required><br>
                <label for="mail">Correo electronico:</label>
                <input type="text" name="email" value="<?=$userInfo->mail?>" required><br>
                <label for="mail">Contraseña:</label>
                <input type="password" name="password" value=""><br>
                <input type="submit" name="updateUser" value="submit">
            </fieldset>        
        </form>
    </main>
</body>
</html>