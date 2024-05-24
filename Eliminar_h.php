<?php 
include "Conexion.php";

if(!empty($_GET["id"])){
    $id = $_GET["id"];
    $sql = $conexion->query("DELETE FROM habilidades WHERE id=$id");
    
    if($sql){
    } else {
    }
} else {
}
?>
