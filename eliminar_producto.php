<?php
include("conexion/conexion.php");

$idProducto = $_GET['id_producto'];

$consulta= "CALL eliminar_producto('$idProducto')";

if(mysqli_query($conectar,$consulta)){
    #REDIRENCIONA A bebida
    header("location:gestion-productos.php");
}else{
    echo "PROBLEMAS AL ELIMINAR EL PRODUCTO";
    echo "<br>CONSULTE AL ADMINISTRADOR";
}

?>