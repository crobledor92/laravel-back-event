<?php
$title="Update registrations";
include ("../header.php");?>
<body>
    <main class="admin_panel">
        <?php 
        if (!isset($_SESSION['personasInscritas'])) {
            header("Location: ../view/admin_view.php");
        }
        include ("../view/navegation_view.php");
        include('../controller/actos_controller.php');
        $inscritos = $_SESSION['personasInscritas'];
        // var_dump($_SESSION['actoIdModificando']);
        ?>
        <h1>Modificar usuarios inscritos</h1>
        <table>
        <thead>
            <tr class='data'>
                <th>Nombre</th>
                <th>Apellidos</th>
                <th>Eliminar inscripción</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach($inscritos as $inscrito):?>
            <tr class="data">
                <td><?=$inscrito->Nombre?></td>
                <td><?=$inscrito->Apellido1 . " " . $inscrito->Apellido2?></td>
                <td>
                    <a href='controller/update_inscritos2_controller.php?id_persona=<?=$inscrito->Id_persona?>&id_acto=<?=$_SESSION['actoIdModificando']?>'>X</a>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
    </main>
</body>
</html>