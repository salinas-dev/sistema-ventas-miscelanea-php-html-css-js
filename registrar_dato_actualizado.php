<?php

include("conexion/conexion.php");
$id_producto = $_POST['txtCodigo'];
$nombre = $_POST['txtNombre'];
$descripcion = $_POST['txtDescripcion'];
$costo_urinario = $_POST['txtCostoUnitario'];
$precio_venta = $_POST['txtPrecioVenta'];
$nombre_marca = $_POST['selectMarca'];
$nombre_categoria = $_POST['selectCategoria'];
$tipo_presentacion = $_POST['selectPresentacion'];
$existencias = $_POST['txtCantidad'];

$consulta = "CALL actualizar_productos('$nombre','$descripcion','$costo_urinario','$precio_venta','$nombre_marca','$nombre_categoria','$tipo_presentacion','$existencias','$id_producto')";

if(mysqli_query($conectar,$consulta)){
    header("location:gestion-productos.php");
}else{
    echo "PROBLEMAS AL REGISTRAR EL PRODUCTO";
    
}
?>