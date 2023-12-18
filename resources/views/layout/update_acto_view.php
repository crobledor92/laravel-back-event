<?php
$title="Add event";
include ("../header.php");?>
<body>
    <main>
        <?php 
        if (!isset($_SESSION['actoData'])) {
            header("Location: ../view/admin_view.php");
        }
        include ("../view/navegation_view.php");
        include('../controller/actos_controller.php');
        $actoData = $_SESSION['actoData'];
        ?>
        <h1>Modificar acto</h1>
        <form action="controller/update_acto2_controller.php" method="post">
            <label>Fecha</label>
            <input type="date" name="fecha" value="<?=$actoData->Fecha?>" required><br>
            <label>Hora</label>
            <input type="time" name="hora" value="<?=$actoData->Hora?>" required><br>
            <label>Title</label>
            <input type="text" name="titulo" value="<?=$actoData->Titulo?>" required><br>
            <label>Resumen</label>
            <input type="text" name="resumen" value="<?=$actoData->Descripcion_corta?>" required><br>
            <label>Descripción</label>
            <input type="text" name="descripcion" value="<?=$actoData->Descripcion_larga?>" required><br>
            <label>Número de asistentes</label>
            <input type="number" name="asistentes" value="<?=$actoData->Num_asistentes?>" required><br>
            <label>Tipo de acto</label>
            <select name="tipoActo" value="<?=$actoData->Id_tipo_acto?>" required>
                <?php
                foreach($listaTiposActos as $tipo) {
                    echo "<option value=". $tipo->Id_tipo_acto . ">" . $tipo->Descripcion . "</option>";
                }
                ?>
            </select>
            <input type="submit" name="updateActo" value="Modificar curso"><br>
        </form>
    </main>
</body>
</html>