<?php
include("conexion/conexion.php");
$nombre_categoria = $_POST['txtNombre_Cat'];


$consulta = "call agrega_cate ( '$nombre_categoria')";

if(mysqli_query($conectar,$consulta)){
    header("location:agregar_marca_catego_presen.php");
}else{
    echo "PROBLEMAS AL REGISTRAR EL PRODUCTO";
    
}
?>