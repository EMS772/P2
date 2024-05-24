<?php
include "Conexion.php";

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["btn_crear"])) {
    if (!empty($_POST["nombre_habilidad"]) && !empty($_POST["tipo_habilidad"]) && !empty($_POST["nivel_poder"]) && !empty($_POST["guerrero_id"])) {
        // Recopilar los datos del formulario
        $nombre_habilidad = $_POST["nombre_habilidad"];
        $tipo_habilidad = $_POST["tipo_habilidad"];
        $nivel_poder = $_POST["nivel_poder"];
        $guerrero_id = $_POST["guerrero_id"];

        // Crear la consulta SQL para insertar los datos en la tabla habilidades
        $sql = "INSERT INTO habilidades (nombre, tipo, nivel_poder, guerrero_id) VALUES ('$nombre_habilidad', '$tipo_habilidad', '$nivel_poder', '$guerrero_id')";
        
        // Ejecutar la consulta SQL
        if ($conexion->query($sql) === TRUE) {
            $message = "Registro de habilidad exitoso";
        } else {
            $message = "Registro de habilidad fallido: " . $conexion->error;
        }
    } else {
        $message = "Algunos campos están vacíos";
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="P.css">
</head>
<body id="habi">


<nav class="navbar navbar-expand-lg navbar-b " id="mainNav">
    <div class="container">
        <a class="navbar-brand" href="#page-top"><img src="/img/pixelcut-export (2).png" alt="..." /></a>
        <button class="navbar-toggler text-white" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            Menu
            <i class="fa-solid fa-bars ms-1"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav text-uppercase ms-auto py-4 py-lg-0">
                <li class="nav-item"><a class="nav-link" href="/Index.php">Inicio</a></li>
                <li class="nav-item"><a class="nav-link" href="/Personajes.php">Personajes</a></li>
                <li class="nav-item"><a class="nav-link" href="/dashboard.php">Dashboard</a></li>
            </ul>
        </div>
    </div>
 </nav>

 <div class="container mt-3 pt-2 bg-transparent ">
    <ol class="breadcrumb ">
        <li class="breadcrumb-item "><a href="index.html">Resumen</a></li>
        <li class="breadcrumb-item active text-white">Habilidades</li>
    </ol>
    
   
    <hr></hr>
    <?php
        include "Conexion.php";
        include "Eliminar_h.php";
         ?>
    <table class="table text-center">
        <thead>
          <tr>
            <th scope="col">ID</th>
            <th scope="col">ID del Guerrero</th>
            <th scope="col">Nombre de la Habilidad</th>
            <th scope="col">Tipo de Habilidad</th>
            <th scope="col">Nivel de Poder</th>
            <th scope="col"></th>
          </tr>
        </thead>
        <tbody >
            <?php 
                $sql = $conexion->query('SELECT * FROM habilidades');
                while ($datos = $sql->fetch_object()) { ?>
                <tr>
                    <td><?php echo  $datos->id; ?></td>
                    <td><?php echo  $datos->guerrero_id; ?></td>
                    <td><?php echo $datos->nombre; ?></td>
                    <td><?php echo $datos->tipo; ?></td>
                    <td><?php echo $datos->nivel_poder; ?></td>

                    <td>
                        <a href="/Mod_h.php?id=<?= $datos->id?>" class="btn btn-small btn-warning"><i class="fas fa-edit"></i></a>
                        <a href="/Habilidades.php?id=<?= $datos->id?>" class="btn btn-small btn-danger"><i class="fa-solid fa-trash"></i></a>
                    </td>
                </tr>
                <?php } ?>
        </tbody>
      </table>
 </div>

 <div class="container-fluid py-5">
    <div class="container py-5 rounded" id="div-r">
        <div class="contact p-5">
            <div class="row g-4">
                <div class="col-xl-5">
                <form method="POST">
                    <h1 class="mb-4">Registro de Habilidades</h1>
                    <?php if (!empty($message)): ?>
                                <div class="alert alert-info"><?php echo $message; ?></div>
                            <?php endif; ?>
                    <div class="row gx-4 gy-3">
                        <div class="col-xl-6">
                            <input type="text" class="form-control bg-white border-0 py-3 px-4" name="nombre_habilidad" placeholder="Nombre de la Habilidad">
                        </div>
                        <div class="col-xl-6">
                            <input type="text" class="form-control bg-white border-0 py-3 px-4" name="tipo_habilidad" placeholder="Tipo">
                        </div>
                        <div class="col-xl-6">
                            <input type="number" class="form-control bg-white border-0 py-3 px-4" name="nivel_poder" placeholder="Nivel de Poder">
                        </div>
                        <div class="col-xl-6">
                            <select class="form-control bg-white border-0 py-3 px-4" name="guerrero_id">
                                <option value="">Seleccionar Peleador</option>
                                <?php 
                                $sql_guerreros = $conexion->query('SELECT * FROM guerreros');
                                while ($fila_guerrero = $sql_guerreros->fetch_assoc()) {
                                    echo '<option value="' . $fila_guerrero["id"] . '">' . $fila_guerrero["nombre"] . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-12">
                            <button class="btn-hover-bg btn btn-primary w-100 py-3 px-5" name="btn_crear" type="submit">Crear</button>
                        </div>
                    </div>
                    </form>
                    <hr>
                </div>
                <div class="col-xl-7">
                    <div>
                        <div class="row g-4">
                            <div class="text-center">
                                <img src="/img/god-of-war-3.jpg" class="rounded" style="height: 412px; margin-bottom: -6px;" alt="...">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="/scripts.js"></script>
</body>
</html>