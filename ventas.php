<?php
// Archivo: ventas.php

include_once "conexion/conexion.php";

// Consulta SQL optimizada
$sentencia = $base_de_datos->query("
    SELECT
        venta_productos.id_venta,
        venta_productos.total_venta,
        venta_productos.fecha,
        GROUP_CONCAT(
            productos.id_producto, 
            '..',
            productos.nombre,
            '..',
            detalle_venta.cantidad,
            '..',
            productos.precio_venta
            SEPARATOR '__'
        ) AS productos
    FROM
        venta_productos
    INNER JOIN
        detalle_venta ON detalle_venta.id_venta = venta_productos.id_venta
    INNER JOIN
        productos ON productos.id_producto = detalle_venta.id_producto
    GROUP BY
        venta_productos.id_venta
    ORDER BY
        venta_productos.id_venta
");

$ventas = $sentencia->fetchAll(PDO::FETCH_OBJ);

// Función para obtener las ventas actualizadas
function obtenerVentasActualizadas($base_de_datos) {
    $sentencia = $base_de_datos->prepare("
        SELECT
            venta_productos.id_venta,
            venta_productos.total_venta,
            venta_productos.fecha,
            GROUP_CONCAT(
                productos.id_producto, 
                '..',
                productos.nombre,
                '..',
                detalle_venta.cantidad,
                '..',
                productos.precio_venta
                SEPARATOR '__'
            ) AS productos
        FROM
            venta_productos
        INNER JOIN
            detalle_venta ON detalle_venta.id_venta = venta_productos.id_venta
        INNER JOIN
            productos ON productos.id_producto = detalle_venta.id_producto
        WHERE
            venta_productos.fecha BETWEEN :fecha_inicio AND :fecha_fin
        GROUP BY
            venta_productos.id_venta
        ORDER BY
            venta_productos.id_venta
    ");

    $sentencia->bindParam(':fecha_inicio', $_POST['fecha_inicio']);
    $sentencia->bindParam(':fecha_fin', $_POST['fecha_fin']);
    $sentencia->execute();
    
    $ventas = $sentencia->fetchAll(PDO::FETCH_OBJ);
    
    return $ventas;
}

// Mostrar ventas
function mostrarVentas($ventas) {
    foreach ($ventas as $venta) {
        ?>
        <tr>
            <td><?php echo $venta->id_venta ?></td>
            <td><?php echo $venta->fecha ?></td>
            <td>
                <table class="table table-bordered text-center" style="background-color: #333; color: white;">
                    <thead>
                        <tr class="text-center" style="background-color: #333; color: white;">
                            <th>Código</th>
                            <th>Descripción</th>
                            <th>Cantidad</th>
                            <th>Precio</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach (explode("__", $venta->productos) as $productosConcatenados) {
                            $producto = explode("..", $productosConcatenados);
                            ?>
                            <tr class="text-center" style="color: white;">
                                <td><?php echo $producto[0] ?></td>
                                <td><?php echo $producto[1] ?></td>
                                <td><?php echo $producto[2] ?></td>
                                <td><?php echo $producto[3] ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </td>
            <td><?php echo $venta->total_venta ?></td>
            <td><a style="font-size: 16px;" class="btn btn-danger text-center" href="<?php echo "eliminarVenta.php?id=" . $venta->id_venta ?>">Eliminar</a></td>
            <td><a style="font-size: 16px;" class="btn btn-primary text-center" href="<?php echo "ticket_venta.php?id=" . $venta->id_venta ?>">Ticket</a></td>
        </tr>
        <?php
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ventas</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="shortcut icon" href="img/iconolanueva.png">


</head>

<body>
<style>
      body {
      background-color: #000000
      }
      </style>

    <div class="container container-sm container-md container-lg container-xl container-xxl">
        <div class="row">
            <div class="col-xs-12">
                <br>
                <h1 style="color: white" class="text-center">Reportes de ventas</h1>
                <div>
                    <a style="font-size: 16px;" class="btn btn-success" href="./vender.php">Nueva venta <i class="fa fa-plus"></i></a>
                </div>
                <br>
                <form action="./generar_ventas.php">
                    <div class="form-inline">
                        <div class="form-group">
                            <label style="color: white; font-size: 16px;" for="fechaInicio">Fecha de inicio:</label>
                            <input style="font-size: 16px;" type="date" class="form-control" id="fechaInicio" name="fechaInicio">
                        </div>
                        <div class="form-group">
                            <label style="color: white; font-size: 16px;"for="fechaFinal">Fecha final:</label>
                            <input style="font-size: 16px;" type="date" class="form-control" id="fechaFinal" name="fechaFinal">
                        </div>
                        <button type="submit" style="font-size: 16px;" class="btn btn-primary">Generar ventas</button>
                    </div>
                </form>

                <br>
                <table class="table table-bordered text-center">
                    <thead style="color: white;">
                        <tr style="background-color: #333; color: white; font-size: 16px;">
                            <th>Número</th>
                            <th>Fecha</th>
                            <th>Productos vendidos</th>
                            <th>Total</th>
                            <th>Eliminar</th>
                            <th>Ticket</th>
                        </tr>
                    </thead>
                    <tbody style="color: white; font-size: 16px;" class="text-center">
                        <?php mostrarVentas($ventas); ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    
    <script>
        // Actualizar las ventas en tiempo real
        setInterval(function() {
            $.ajax({
                url: 'obtener_ventas_actualizadas.php',
                dataType: 'json',
                success: function(data) {
                    $('tbody').empty();
                    mostrarVentas(data);
                }
            });
        }, 1000);
    </script>
</body>

</html>
