<?php 
include "Conexion.php";

// Verificar si la variable $_GET["id"] está definida y no está vacía
if(isset($_GET["id"]) && !empty($_GET["id"])) {
    // Obtener el ID de la URL
    $id = $_GET["id"];
    
    // Consultar la base de datos
    $sql = $conexion->query("SELECT * FROM habilidades WHERE id='$id'");
    
    // Verificar si la consulta se ejecutó correctamente
    if($sql) {
        // Comprobar si se ha enviado el formulario
        if(!empty($_POST["btnregistrar"])){
            if(!empty($_POST["guerrero_id"]) && !empty($_POST["nombre"]) && !empty($_POST["tipo"]) && !empty($_POST["nivel_poder"])){
                // Obtener los valores del formulario
                $guerrero_id = $_POST["guerrero_id"];
                $nombre = $_POST["nombre"];
                $tipo = $_POST["tipo"];
                $nivel_poder = $_POST["nivel_poder"];

                // Actualizar los datos en la base de datos
                $update_sql = $conexion->query("UPDATE habilidades SET guerrero_id='$guerrero_id', nombre='$nombre', tipo='$tipo', nivel_poder='$nivel_poder' WHERE id='$id'");

                if($update_sql) {
                    header("Location:Habilidades.php");
                } else {
                    echo "<div class='alert alert-danger'>Error al actualizar los datos</div>";
                }
            } else {
                echo "<div class='alert alert-warning'>Campos vacíos</div>";
            }
        }
    } else {
        echo "<div class='alert alert-danger'>Error en la consulta SQL: " . $conexion->error . "</div>";
    }
} else {
    echo "<div class='alert alert-danger'>ID no definido</div>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modificar Habilidad</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
</head>
<body>
<form class="col-4 p-3 m-auto" method="POST" >
    <h5 class="text-center alert alert-secondary mb-4">Modificar Habilidad</h5>
    <input type="hidden" name="id" value="<?= isset($_GET["id"]) ? $_GET["id"] : '' ?>" >
    <?php
    if($sql && $sql->num_rows > 0) {
        while($datos = $sql->fetch_object()){?>
            <div class="row gx-4 gy-3">
                <div class="col-xl-12">
                    <input type="hidden" class="form-control border-0 py-3 px-4" name="guerrero_id" value="<?php echo $datos->guerrero_id ?>" placeholder="ID del Guerrero">
                </div>
                <div class="col-xl-12">
                    <input type="text" class="form-control border-0 py-3 px-4" name="nombre" value="<?php echo $datos->nombre ?>" placeholder="Nombre de la Habilidad">
                </div>
                <div class="col-xl-12">
                    <input type="text" class="form-control border-0 py-3 px-4" name="tipo" value="<?php echo $datos->tipo ?>" placeholder="Tipo">
                </div>
                <div class="col-xl-12">
                    <input type="text" class="form-control border-0 py-3 px-4" name="nivel_poder" value="<?php echo $datos->nivel_poder ?>" placeholder="Nivel de Poder">
                </div>
                <div class="col-12">
                    <button class="btn-hover-bg btn btn-primary w-100 py-3 px-5" name="btnregistrar" value="ok" type="submit">Modificar habilidad</button>
                </div>
            </div>
    <?php }
    }
    ?>
    <hr>
</form>              
</body>
</html>

