<?php
$host="localhost";
$user="root";
$pass="";
$db="tienda";

$conexion = new mysqli($host,$user,$pass,$db);

if($conexion->connect_error){
    die("Error de conexión: " . $conexion->connect_error);
}
mysqli_set_charset($conexion, "utf8");
?>