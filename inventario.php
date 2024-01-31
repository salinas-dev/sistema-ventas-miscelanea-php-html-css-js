<?php
include("conexion/conexion.php");
$productos = [];

if (isset($_GET['buscar'])) {
    $filtro = $_GET['filtro'];
    $termino = $_GET['termino'];

    switch ($filtro) {
        case 'nombre':
            $sentencia = $base_de_datos->prepare("SELECT * FROM productos WHERE nombre LIKE '%$termino%';");
            break;
        case 'id_producto':
            $sentencia = $base_de_datos->prepare("SELECT * FROM productos WHERE id_producto LIKE '%$termino%';");
            break;
        case 'id_marca':
            $sentencia = $base_de_datos->prepare("SELECT * FROM productos WHERE id_marca LIKE '%$termino%';");
            break;
        case 'id_categoria':
            $sentencia = $base_de_datos->prepare("SELECT categoria_de_productos.nombre_categoria 
                                                    FROM productos INNER JOIN categoria_de_productos 
                                                    ON productos.id_categoria = categoria_de_productos.id_categoria 
                                                    WHERE nombre_categoria LIKE '%$termino%';");
            break;
        default:
            $sentencia = $base_de_datos->query("SELECT * FROM productos;");
            break;
    }

    $sentencia->execute();
    $productos = $sentencia->fetchAll(PDO::FETCH_OBJ);
} else {
    $sentencia = $base_de_datos->query("SELECT * FROM productos;");
    $productos = $sentencia->fetchAll(PDO::FETCH_OBJ);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventario</title>
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
        <h1 style="color: white; font-size: 40px;" class="text-center">Inventario</h1>
    <form method="GET" action="">
        <div class="form-group">
            <label for="filtro" style="color: white; font-size: 20px;">Filtrar por:</label>
            <select class="form-control" style="font-size: 16px;" name="filtro" id="filtro">
                <option value="nombre">Nombre</option>
                <option value="id_producto">Código</option>
                <option value="id_marca">Marca</option>
                <option value="nombre_categoria">Categoría</option>
                <option value="existencias">Existencias</option>

            </select>
            <label for="termino" style="color: white; font-size: 20px;">Término de búsqueda:</label>
            <input style="font-size: 16px;"  class="form-control" type="text" name="termino" id="termino" placeholder="Escribe el término de búsqueda" required>
            <br>
            <button style="font-size: 16px;" class="btn btn-success" type="submit" name="buscar">Buscar</button>
        </div>
    </form>
    <div class="table-responsive">
        <?php if (count($productos) > 0): ?>
            <table class="table table-bordered text-center">
                <thead>
                    <tr style=" font-size: 15px; background-color: #333; color: white;">
                        <th>Código de Barras</th>
                        <th>Nombre</th>
                        <th>Descripción</th>
                        <th>Costo unitario</th>
                        <th>Precio de venta</th>
                        <th>Marca</th>
                        <th>Categoría</th>
                        <th>Presentación</th>
                        <th>Existencia</th>
                    </tr>
                </thead>
                <tbody style="font-size: 15px;" >
                <?php foreach($productos as $producto): ?>
                    <tr style="background-color: #333; color: white;">
                        <td><?= $producto->id_producto ?></td>
                        <td><?= $producto->nombre ?></td>
                        <td><?= $producto->descripcion ?></td>
                        <td><?= $producto->costo_urinario ?></td>
                        <td><?= $producto->precio_venta ?></td>
                        <td>
                        <?php
                                $id_marca = $producto->id_marca;
                                $marca_query = $base_de_datos->prepare("SELECT nombre_marca FROM marca_productos WHERE id_marca = :id_marca");
                                $marca_query->bindParam(':id_marca', $id_marca);
                                $marca_query->execute();
                                $marca = $marca_query->fetch(PDO::FETCH_OBJ);
                                echo $marca->nombre_marca;
                        ?>    
                        </td>
                        <td>
                            <!--
                                $id_categoria = $producto->id_categoria;: 
                                Almacena el valor del campo id_categoria 
                                del producto actual en la variable $id_categoria. 
                                Esto es necesario para realizar la consulta SQL y obtener 
                                el nombre de la categoría.

                                $categoria_query = $base_de_datos->prepare("SELECT 
                                nombre_categoria FROM categoria_de_productos WHERE id_categoria 
                                = :id_categoria");: Prepara una consulta SQL para seleccionar el campo 
                                nombre_categoria de la tabla categoria_de_productos donde el id_categoria 
                                sea igual al valor almacenado en la variable $id_categoria.

                                $categoria_query->bindParam(':id_categoria', $id_categoria);: 
                                Vincula el valor de $id_categoria al parámetro :id_categoria en la 
                                consulta preparada. Esto asegura que el valor sea tratado de manera 
                                segura para evitar inyección de SQL.

                                $categoria_query->execute();: Ejecuta la consulta preparada.

                                $categoria = $categoria_query->fetch(PDO::FETCH_OBJ);: 
                                Obtiene la fila de resultados de la consulta y la almacena en 
                                la variable $categoria. Aquí asumimos que solo se espera una fila 
                                de resultado, ya que se busca una coincidencia exacta del id_categoria.

                                echo $categoria->nombre_categoria;: Imprime el valor del campo 
                                nombre_categoria del objeto $categoria. Esto muestra el nombre de la 
                                categoría correspondiente al producto actual en la tabla.-->
                            <?php
                                $id_categoria = $producto->id_categoria;
                                $categoria_query = $base_de_datos->prepare("SELECT nombre_categoria FROM categoria_de_productos WHERE id_categoria = :id_categoria");
                                $categoria_query->bindParam(':id_categoria', $id_categoria);
                                $categoria_query->execute();
                                $categoria = $categoria_query->fetch(PDO::FETCH_OBJ);
                                echo $categoria->nombre_categoria;
                            ?>
                        </td>
                        <td><?= $producto->id_precentacion ?></td>
                        <td><?= $producto->existencias ?></td>
                    </tr>
                <?php endforeach; ?>

                </tbody>
            </table>
        <?php else: ?>
            <p style="color: white; font-size: 20px;">No se encontraron resultados.</p>
        <?php endif; ?>
    </div>
</div>
</div>
</div>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</body>
</html>
