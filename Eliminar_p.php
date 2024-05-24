<?php 
include "Conexion.php";

if(!empty($_GET["id"])){
    $id = $_GET["id"];
    $sql = $conexion->query("DELETE FROM guerreros WHERE id=$id");
    
    if($sql==1){
    } else {
    }
} else {
}
?>
