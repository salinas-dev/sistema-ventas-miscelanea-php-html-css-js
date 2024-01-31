<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>La Nueva</title>
    <link rel="stylesheet" href="agregar-producto.html">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
<link rel="shortcut icon" href="img/iconolanueva.png">
     </head>
     <body >
     <form action="agregar-producto.php" method="post">

        <p class="fw-bold text-light bg-dark" >Gestion de Productos</p>

        <style>
          body {
          background-color: #000000
          }
          </style>
        <main class="container ">  
            <section class="row ">
               
 <!--ESTE  IFRAME SERVIRA PARA AGREGAR UN NUEVO PRODUCTO -->

 <iframe src="agregar-producto.php" frameborder="3" name="iframe_de_agregar" width="800px" height="500px" class="agregar" id="ocultar_pag_agrega"></iframe>

 <div class="table-responsive">
    <table class="table  text-light bg-dark text-center">
                        <thead>
                          <tr style="background-color: #333; color: white;" class=" col col-md-0.9">
                            <th scope="col " >Codigo</th>
                            <th scope="col">Nombre del Producto</th>
                            <th scope="col">Descripcion</th>
                            <th scope="col">Costo Urinario</th>
                            <th scope="col">Precio Venta</th>
                            <th scope="col">Marca</th>
                            <th scope="col">Categoria</th>
                            <th scope="col">Presentacion</th>
                            <th scope="col">Cantidad</th>
                          </tr>
                        </thead>
                        <?php
include("conexion/conexion.php");

$consulta = "SELECT
    productos.id_producto, 
    productos.nombre, 
    productos.descripcion, 
    productos.costo_urinario, 
    productos.precio_venta, 
    marca_productos.nombre_marca, 
    categoria_de_productos.nombre_categoria, 
    presentacion_productos.tipo_presentacion, 
    productos.existencias, 
    productos.estatus
FROM
    productos
    INNER JOIN marca_productos
    ON productos.id_marca = marca_productos.id_marca
    INNER JOIN presentacion_productos
    ON productos.id_precentacion = presentacion_productos.id_presentacion
    INNER JOIN categoria_de_productos
    ON productos.id_categoria = categoria_de_productos.id_categoria
WHERE estatus = '1'";

// Ejecutando la consulta
$producto = mysqli_query($conectar, $consulta);

// Extraer datos de productos
while ($regProducto = mysqli_fetch_assoc($producto)) {
    $idProducto = $regProducto["id_producto"];
    echo "<tr>" .
        "<td>" . $regProducto["id_producto"] . "</td>" .
        "<td>" . $regProducto["nombre"] . "</td>" .
        "<td>" . $regProducto["descripcion"] . "</td>" .
        "<td>" . $regProducto["costo_urinario"] . "</td>" .
        "<td>" . $regProducto["precio_venta"] . "</td>" .
        "<td>" . $regProducto["nombre_marca"] . "</td>" .
        "<td>" . $regProducto["nombre_categoria"] . "</td>" .
        "<td>" . $regProducto["tipo_presentacion"] . "</td>" .
        "<td>" . $regProducto["existencias"] . "</td>" .
        "<td><a href='actualizar_producto.php?id_producto=$idProducto'><img src='img/editar.png' width='25' height='25'></a></td>" .
        "<td><a href='eliminar_producto.php?id_producto=$idProducto' onclick='return confirmarEliminacion()'><img src='img/eliminar.png' width='25' height='25'></a></td>" .
        "</tr>";
}
?>

<script>
function confirmarEliminacion() {
    return confirm("¿Estás seguro de que quieres eliminar este producto?");
}
</script>

    </table>
 </div>
             
              <!--ESTE  BOTTON SERVIRA PARA DIRIGIRCE ALA PAGINA DE AGREGAR  -->
                      <article class="col col-md-6 bg-dark text-bg-primary p-4"> 
                      <button type="submit" class="btn btn-secondary">REGISTRAR PRODUCTO</button>
                    <!--a class="boton" href="agregar-producto.php" target="iframe_de_agregar" id="mostrar_pag" onclick="mostrar()">Agregar Producto </!--a-->
                    </article>
                    <article class="col col-md-6 bg-dark text-bg-primary p-4"> 
                    <form>
                                    <button type="submit" formaction="agregar_marca_catego_presen.php" class="btn btn-secondary">Agregar marca categoria presentacion</button>
                                </form>
        </article>
                    <!--a class="boton" href="agregar-producto.php" target="iframe_de_agregar" id="mostrar_pag" onclick="mostrar()">Agregar Producto </!--a-->
                    </article>
          </section>
        </main>


        <style>
          #ocultar_pag_agrega{
            display: none;
          }
        </style>
    
        <script>
          function mostrar(){
            document.getElementById('ocultar_pag_agrega').style.display = 'block'; 
          }
        </script>
        
      </script>
      <script src="js/bootstrap.bundle.min.js"> 
      </script>
     </body>
</html>