<?php
include("conexion/conexion.php");
$nombre_marca = $_POST['txtNombre_Mar'];


$consulta = "call agrega_marca ( '$nombre_marca')";

if(mysqli_query($conectar,$consulta)){
    header("location:agregar_marca_catego_presen.php");
}else{
    echo "PROBLEMAS AL REGISTRAR EL PRODUCTO";
    
}
?>