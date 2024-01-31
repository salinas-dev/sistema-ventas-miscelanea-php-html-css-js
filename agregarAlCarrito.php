<?php
if (!isset($_POST["id_producto"])) {
    return;
}

$id_producto = $_POST["id_producto"];
include_once "conexion/conexion.php";
$sentencia = $base_de_datos->prepare("SELECT * FROM productos WHERE id_producto = ? LIMIT 1;");
$sentencia->execute([$id_producto]);
$producto = $sentencia->fetch(PDO::FETCH_OBJ);

if ($producto) {
    if ($producto->existencias < 1) {
        header("Location: ./vender.php?status=5");
        exit;
    }

    session_start();
    $indice = false;

    for ($i = 0; $i < count($_SESSION["carrito"]); $i++) {
        if ($_SESSION["carrito"][$i]->id_producto === $id_producto) {
            $indice = $i;
            break;
        }
    }

    if ($indice === false) {
        $producto->cantidad = 1;
        $producto->total = $producto->precio_venta;
        array_push($_SESSION["carrito"], $producto);
    } else {
        $_SESSION["carrito"][$indice]->cantidad++;
        $_SESSION["carrito"][$indice]->total = $_SESSION["carrito"][$indice]->cantidad * $_SESSION["carrito"][$indice]->precio_venta;
    }

    header("Location: ./vender.php");
} else {
    header("Location: ./vender.php?status=4");
}

// Generar el ticket solo si hay productos en el carrito
if (!empty($_SESSION["carrito"])) {
    $total = 0;
    foreach ($_SESSION["carrito"] as $producto) {
        $total += $producto->total;
    }

    // Resto del código para generar el ticket
}
?>
