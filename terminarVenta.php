<?php
if (!isset($_POST["total"])) exit;

session_start();

$total = $_POST["total"];
include_once "conexion/conexion.php";

if (!empty($_SESSION["carrito"])) {
    $sentencia = $base_de_datos->prepare("INSERT INTO venta_productos(total_venta, fecha) VALUES (?, NOW());");
    $sentencia->execute([$total]);

    $idVenta = $base_de_datos->lastInsertId();

    $base_de_datos->beginTransaction();
    $sentencia = $base_de_datos->prepare("INSERT INTO detalle_venta(id_producto, id_venta, cantidad) VALUES (?, ?, ?);");
    foreach ($_SESSION["carrito"] as $producto) {
        $sentencia->execute([$producto->id_producto, $idVenta, $producto->cantidad]);
    }
    $base_de_datos->commit();
    unset($_SESSION["carrito"]);
    $_SESSION["carrito"] = [];

    // Obtener los productos vendidos en la venta
    $sentenciaProductosVendidos = $base_de_datos->prepare("SELECT * FROM detalle_venta INNER JOIN productos ON detalle_venta.id_producto = productos.id_producto WHERE id_venta = ?;");
    $sentenciaProductosVendidos->execute([$idVenta]);
    $productosVendidos = $sentenciaProductosVendidos->fetchAll(PDO::FETCH_ASSOC);

    // Generar el ticket
    ob_start();
    include "ticket_template.php";
    $ticket = ob_get_clean();

    // Imprimir el ticket
    echo $ticket;
}
?>
