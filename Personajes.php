<?php
include "Conexion.php";

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["btn_crear"])) {
    if (!empty($_POST["nombre"]) && !empty($_POST["apellido"]) && !empty($_POST["fecha"])) {
        $nombre = $_POST["nombre"];
        $apellido = $_POST["apellido"];
        $fecha = $_POST["fecha"];

        $sql = "INSERT INTO guerreros (nombre, apellido, fecha_nacimiento) VALUES ('$nombre', '$apellido', '$fecha')";
        if ($conexion->query($sql) === TRUE) {
            $message = "Registro exitoso";
        } else {
            $message = "Registro fallido: " . $conexion->error;
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
<body id="momo">
    
    <nav class="navbar navbar-expand-lg navbar-b" id="mainNav">
        <div class="container">
            <a class="navbar-brand" href="#page-top"><img src="/img/pixelcut-export (2).png" alt="..." /></a>
            <button class="navbar-toggler text-white" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                Menu
                <i class="fa-solid fa-bars ms-1"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav text-uppercase ms-auto py-4 py-lg-0">
                    <li class="nav-item"><a class="nav-link" href="/Index.php">Inicio</a></li>
                    <li class="nav-item"><a class="nav-link" href="/Habilidades.php">Habilidades</a></li>
                    <li class="nav-item"><a class="nav-link" href="/dashboard.php">Dashboard</a></li>

                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-3 pt-2 bg-transparent">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.html">Resumen</a></li>
            <li class="breadcrumb-item active text-white">Usuarios</li>
        </ol>
        
        
        <hr>
        <?php
        include "Conexion.php";
        include "Eliminar_p.php";
         ?>
        <table class="table text-center">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Apellido</th>
                    <th scope="col">Fecha de Nacimiento</th>
                    <th scope="col">Acciones</th>
                </tr>
            </thead>
            <tbody id="tabla-usuarios">
                <?php 
                $sql = $conexion->query('SELECT * FROM guerreros');
                while ($datos = $sql->fetch_object()) { ?>
                <tr>
                    <td><?php echo  $datos->id; ?></td>
                    <td><?php echo  $datos->nombre; ?></td>
                    <td><?php echo $datos->apellido; ?></td>
                    <td><?php echo $datos->fecha_nacimiento; ?></td>
                    <td>
                        <a href="/Mod_p.php?id=<?= $datos->id?>" class="btn btn-small btn-warning"><i class="fas fa-edit"></i></a>
                        <a href="/Personajes.php?id=<?= $datos->id?>" class="btn btn-small btn-danger"><i class="fa-solid fa-trash"></i></a>
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
                            <h1 class="mb-4">Registro de Personajes</h1>
                            <?php if (!empty($message)): ?>
                                <div class="alert alert-info"><?php echo $message; ?></div>
                            <?php endif; ?>
                            <div class="row gx-4 gy-3">
                                <div class="col-xl-6">
                                    <input type="text" class="form-control bg-white border-0 py-3 px-4" name="nombre" placeholder="Nombre:">
                                </div>
                                <div class="col-xl-6">
                                    <input type="text" class="form-control bg-white border-0 py-3 px-4" name="apellido" placeholder="Apellido:">
                                </div>
                                <div class="col-xl-6">
                                    <input type="date" class="form-control" name="fecha">
                                </div>
                                <div class="col-12">
                                    <button class="btn-hover-bg btn btn-primary w-100 py-3 px-5" name="btn_crear" type="submit">Crear</button>
                                </div>
                            </div>
                            <hr>
                        </form>
                    </div>
                    <div class="col-xl-7">
                        <div>
                            <div class="row g-4">
                                <div class="text-center">
                                    <img src="/img/gaming-leon.jpg" class="rounded" style="height: 412px; margin-bottom: -6px;" alt="...">
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
