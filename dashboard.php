<?php
include "Conexion.php";

// Cantidad total de guerreros registrados
$sql_guerreros_total = $conexion->query('SELECT COUNT(*) AS total_guerreros FROM guerreros');
$row_guerreros_total = $sql_guerreros_total->fetch_assoc();
$total_guerreros = $row_guerreros_total['total_guerreros'];

// Cantidad total de habilidades registradas
$sql_habilidades_total = $conexion->query('SELECT COUNT(*) AS total_habilidades FROM habilidades');
$row_habilidades_total = $sql_habilidades_total->fetch_assoc();
$total_habilidades = $row_habilidades_total['total_habilidades'];

// Promedio de habilidades por guerrero
if ($total_guerreros > 0) {
    $promedio_habilidades_por_guerrero = round($total_habilidades / $total_guerreros, 2);
} else {
    $promedio_habilidades_por_guerrero = 0;
}

// Edad promedio de los guerreros
$sql_edad_promedio = $conexion->query('SELECT AVG(DATEDIFF(CURDATE(), fecha_nacimiento)) AS edad_promedio FROM guerreros');
$row_edad_promedio = $sql_edad_promedio->fetch_assoc();
$edad_promedio = round($row_edad_promedio['edad_promedio'] / 365, 2); // Convertir días a años y redondear a 2 decimales

// Nivel de poder promedio de las habilidades
$sql_nivel_poder_promedio = $conexion->query('SELECT AVG(nivel_poder) AS nivel_poder_promedio FROM habilidades');
$row_nivel_poder_promedio = $sql_nivel_poder_promedio->fetch_assoc();
$nivel_poder_promedio = round($row_nivel_poder_promedio['nivel_poder_promedio'], 2);

// La habilidad más poderosa y la menos poderosa
$sql_habilidad_mas_poderosa = $conexion->query('SELECT MAX(nivel_poder) AS max_nivel_poder FROM habilidades');
$row_habilidad_mas_poderosa = $sql_habilidad_mas_poderosa->fetch_assoc();
$habilidad_mas_poderosa = $row_habilidad_mas_poderosa['max_nivel_poder'];

$sql_habilidad_menos_poderosa = $conexion->query('SELECT MIN(nivel_poder) AS min_nivel_poder FROM habilidades');
$row_habilidad_menos_poderosa = $sql_habilidad_menos_poderosa->fetch_assoc();
$habilidad_menos_poderosa = $row_habilidad_menos_poderosa['min_nivel_poder'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Estadísticas</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="P.css">
</head>
<body id="panel">
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
                    <li class="nav-item"><a class="nav-link" href="/Personajes.php">Personajes</a></li>
                    <li class="nav-item"><a class="nav-link" href="/Habilidades.php">Habilidades</a></li>

                </ul>
            </div>
        </div>
    </nav>
<div class="container mt-5" >
    <h1 class="text-center text-white mb-4">Panel de Estadísticas</h1>
    <div class="row">
        <div class="col-md-6">
            <div class="card mb-4 bg-danger bg-opacity-75">
                <div class="card-header text-white">
                    Cantidad Total de Guerreros Registrados
                </div>
                <div class="card-body text-white">
                    <h5 class="card-title text-center"><?php echo $total_guerreros; ?></h5>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card mb-4  bg-danger bg-opacity-75">
                <div class="card-header text-white">
                    Cantidad Total de Habilidades Registradas
                </div>
                <div class="card-body text-white">
                    <h5 class="card-title text-center"><?php echo $total_habilidades; ?></h5>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="card mb-4  bg-danger bg-opacity-75">
                <div class="card-header text-white">
                    Promedio de Habilidades por Guerrero
                </div>
                <div class="card-body text-white">
                    <h5 class="card-title text-center"><?php echo $promedio_habilidades_por_guerrero; ?></h5>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card mb-4  bg-danger bg-opacity-75">
                <div class="card-header text-white">
                    Edad Promedio de los Guerreros
                </div>
                <div class="card-body text-white">
                    <h5 class="card-title text-center"><?php echo $edad_promedio; ?> años</h5>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="card mb-4  bg-danger bg-opacity-75">
                <div class="card-header text-white">
                    Nivel de Poder Promedio de las Habilidades
                </div>
                <div class="card-body text-white">
                    <h5 class="card-title text-center"><?php echo $nivel_poder_promedio; ?></h5>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card mb-4  bg-danger bg-opacity-75">
                <div class="card-header text-white">
                    Habilidad Más Poderosa
                </div>
                <div class="card-body text-white">
                    <h5 class="card-title text-center"><?php echo $habilidad_mas_poderosa; ?></h5>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6 offset-md-3">
            <div class="card mb-4  bg-danger bg-opacity-75">
                <div class="card-header text-white">
                    Habilidad Menos Poderosa
                </div>
                <div class="card-body text-white">
                    <h5 class="card-title text-center"><?php echo $habilidad_menos_poderosa; ?></h5>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
