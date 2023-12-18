@include('common/session')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel personal - Back Event</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="icon" href="img/favicon.ico" type="image/x-icon">
</head>
<body>
    @include('common/navegation')
    <main>
        <h1>Panel de usuario</h1>
        <?php
        if($userInfo == ""){
            header("Location: ../controller/login_controller.php");
        }else{
            include('../controller/actos_controller.php');
            require_once("../view/calendar_view.php");
        }
        ?>
        <p id="timedMessage">Te has conectado correctamente</p>
        <script>
            function timedMsg(){
                var t=setTimeout("document.getElementById('timedMessage').style.display='none';",4000);
            }
            timedMsg()
        </script>
    </main>
</body>
</html>