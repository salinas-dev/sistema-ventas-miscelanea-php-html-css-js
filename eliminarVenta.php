<?php
if (!isset($_GET["id_venta"])) {
    exit();
}

$id = $_GET["id_venta"];
include_once "conexion/conexion.php";
$sentencia = $base_de_datos->prepare("DELETE FROM venta_productos WHERE id_venta = ?;");
$resultado = $sentencia->execute([$id]);

if ($resultado === TRUE) {
    header("Location: ./ventas.php");
    exit;
} else {
    echo "Algo salió mal";
}
?>
