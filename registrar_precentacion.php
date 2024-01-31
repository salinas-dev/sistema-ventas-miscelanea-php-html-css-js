<?php
include("conexion/conexion.php");
$tipo_presentacion = $_GET['txtNombre_Pre'];

// Verificar si el valor no está vacío
if (!empty($tipo_presentacion)) {
    $consulta = "CALL agrega_presenta('$tipo_presentacion')";

    if (mysqli_query($conectar, $consulta)) {
        header("location:agregar_marca_catego_presen.php");
    } else {
        echo "PROBLEMAS AL REGISTRAR EL PRODUCTO";
    }
} else {
    echo "El valor no puede estar vacío";
}
