<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>La Nueva</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
  <link rel="shortcut icon" href="img/iconolanueva.png">
</head>

<body>
  <style>
    body {
      background-color: #000000
    }
  </style>
  <?php
  include("conexion/conexion.php");

  $idProductoGet = $_GET['id_producto'];

  $consulta = "SELECT
        productos.id_producto,
        productos.nombre, 
        productos.descripcion, 
        productos.costo_urinario, 
        productos.precio_venta, 
        marca_productos.nombre_marca, 
        categoria_de_productos.nombre_categoria, 
        presentacion_productos.tipo_presentacion, 
        productos.existencias
        FROM
        productos
        INNER JOIN
        marca_productos
        ON 
          productos.id_marca = marca_productos.id_marca
        INNER JOIN
        presentacion_productos
        ON 
          productos.id_precentacion = presentacion_productos.id_presentacion
        INNER JOIN
        categoria_de_productos
        ON 
          productos.id_categoria = categoria_de_productos.id_categoria
        WHERE
        productos.id_producto = '$idProductoGet'";

  $productos = mysqli_query($conectar, $consulta);
  $regproducto = mysqli_fetch_array($productos);

  ?>
  <form action="registrar_dato_actualizado.php" method="post">

    <main class="container ">
      <section class="row ">
        <!-- Usamos un etiqueta de tipo text -->
        <article class="col col-md-6 bg-dark text-bg-primary p-4">
          <label>Codigo Producto:</label>
          <input readonly type="text" name="txtCodigo" value="<?php echo $regproducto[0] ?>" class="input-group-text">
        </article>
        <!-- Usamos un etiqueta de tipo text -->
        <article class="col col-md-6 bg-dark text-bg-primary p-4">
          <label>Nombre Producto:</label>
          <input type="text" name="txtNombre" value="<?php echo $regproducto[1] ?>" class="input-group-text">
        </article>
        <!-- Usamos un etiqueta de tipo text -->
        <article class="col col-md-4 bg-dark text-bg-primary p-4">
          <label>Descripcion Producto:</label>
          <input type="text" name="txtDescripcion" value="<?php echo $regproducto[2] ?>" class="input-group-text">
        </article>
        <!-- Usamos un etiqueta de tipo text -->
        <article class="col col-md-4 bg-dark text-bg-primary p-4">
          <label>Costo Unitario:</label>
          <input type="text" name="txtCostoUnitario" value="<?php echo $regproducto[3] ?>" class="input-group-text">
        </article>
        <!-- Usamos un etiqueta de tipo text -->
        <article class="col col-md-4 bg-dark text-bg-primary p-4">
          <label>Precio Venta:</label>
          <input type="text" name="txtPrecioVenta" value="<?php echo $regproducto[4] ?>" class="input-group-text">
        </article>
        <!-- SELECT para llenar el campo de marca -->
        <article class="col col-md-2.4 bg-dark text-bg-primary p-4">
          <label>Marca:</label>
          <select name="selectMarca" class="form-select">
            <option value="">--Seleccione--</option>
            <?php
            include("conexion/conexion.php");
            $consulta = "SELECT id_marca, nombre_marca FROM marca_productos;";
            $marca = mysqli_query($conectar, $consulta);
            while ($regMarca = mysqli_fetch_array($marca)) {
              $selected = ($regMarca[1] == $regproducto[5]) ? "selected" : "";
              echo "<option value='" . $regMarca[1] . "' " . $selected . ">" . $regMarca[1] . "</option>";
            }
            ?>
          </select>
        </article>
        <!-- El resto del código... -->
        <article class="col col-md-2.4 bg-dark text-bg-primary p-4">
          <label>Categoria:</label>
          <select name="selectCategoria" class="form-select">
            <option value="">--Seleccione--</option>
            <?php
            include("conexion/conexion.php");
            $consulta = "SELECT id_categoria, nombre_categoria FROM categoria_de_productos;";
            $categoria = mysqli_query($conectar, $consulta);
            while ($regCategoria = mysqli_fetch_array($categoria)) {
              $selected = ($regCategoria[1] == $regproducto[6]) ? "selected" : "";
              echo "<option value='" . $regCategoria[1] . "' " . $selected . ">" . $regCategoria[1] . "</option>";
            }
            ?>
          </select>
        </article>
        <!-- El resto del código... -->
        <article class="col col-md-2.4 bg-dark text-bg-primary p-4">
          <label>Presentacion:</label>
          <select name="selectPresentacion" class="form-select">
            <option value="">--Seleccione--</option>
            <?php
            include("conexion/conexion.php");
            $consulta = "SELECT id_presentacion, tipo_presentacion FROM presentacion_productos;";
            $presentacion = mysqli_query($conectar, $consulta);
            while ($regPresentacion = mysqli_fetch_array($presentacion)) {
              $selected = ($regPresentacion[1] == $regproducto[7]) ? "selected" : "";
              echo "<option value='" . $regPresentacion[1] . "' " . $selected . ">" . $regPresentacion[1] . "</option>";
            }
            ?>
          </select>
          </select>
        </article>
        <!-- SELECT para llenar el campo de cantidad -->
        <article class="col col-md-2.4 bg-dark text-bg-primary p-4">
          <label>Cantidad:</label>
          <input type="text" name="txtCantidad" value="<?php echo $regproducto[8] ?>" class="input-group-text"><br>
        </article>
        </table>
        <article class="col col-md-6 bg-dark text-bg-primary p-4">
          <button type="summit" class="btn btn-secondary">Actualizar Producto</button>
        </article>
        <article class="col col-md-6 bg-dark text-bg-primary p-4">
          <a class="btn btn-secondary" href="#" id="cancelarBtn" onclick="window.history.back();">Cancelar</a>
        </article>
        <style>
          .boton {
            display: inline-block;
            background-color: dimgrey;
            margin: 15px;
            padding: 15px;
            font-size: 1.25em;
            text-align: center;
            text-decoration: none;
            color: black;

          }
        </style>

  </form>
  </script>
  <script src="js/bootstrap.bundle.min.js">
  </script>
</body>

</html>