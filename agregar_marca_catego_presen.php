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

<body>

    <p class="fw-bold text-light bg-dark">Agregar Marca Categoria y Presentacion</p>

    <main class="container">
        <section class="row">
            <div class="container text-center">
                <div class="row align-items-start">
                    <div class="col">
                        <form action="registrar_marca.php" method="post">
                            <article class="col col-md-12 bg-dark text-bg-primary p-4">
                                <label class="container text-start">Nombre de la Marca:</label>
                                <input type="text" id="txtNombre_Mar" name="txtNombre_Mar" class="input-group-text" required>
                            </article>
                            <article class="col col-md-12 bg-dark text-bg-primary p-4">
                                <button type="submit" name="registrar_marca" class="btn btn-secondary">REGISTRAR MARCA</button>
                            </article>
                        </form>
                    </div>

                    <div class="col">
                        <form action="registrar_categoria.php" method="post">
                            <article class="col col-md-12 bg-dark text-bg-primary p-4">
                                <label class="container text-start">Nombre de Categoría:</label>
                                <input type="text" id="txtNombreCat" name="txtNombre_Cat" class="input-group-text" required>
                            </article>
                            <article class="col col-md-12 bg-dark text-bg-primary p-4">
                                <button type="submit" name="agregar_categoria" class="btn btn-secondary">Agregar Categoría</button>
                            </article>
                        </form>

                    </div>
                    <div class="col">
                        <form action="registrar_precentacion.php" method="get">
                            <article class="col col-md-12 bg-dark text-bg-primary p-4">
                                <label class="container text-start">Nombre de Presentación:</label>
                                <input type="text" id="txtNombrePre" name="txtNombre_Pre" class="input-group-text" required>
                            </article>
                            <article class="col col-md-12 bg-dark text-bg-primary p-4">
                                <button type="submit" name="agregar_presentacion" class="btn btn-secondary">Agregar Presentación</button>
                            </article>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <main class="container">
        <section class="row">
            <div class="container text-center">
                <div class="row align-items-center">
                    <div class="col">
                        <div class="table-responsive">
                            <table class="table text-light bg-dark" class="text-center">
                                <thead>
                                    <tr class="">
                                        <th scope="col">Codigo</th>
                                        <th scope="col">Nombre Marca</th>
                                    </tr>
                                </thead>
                                <?php
                                include("conexion/conexion.php");
                                //$consulta = "SELECT * FROM productos WHERE estatus = '1'";
                                $consulta = "SELECT marca_productos.id_marca, marca_productos.nombre_marca FROM marca_productos";

                                $marcas_productos = mysqli_query($conectar, $consulta);
                                //Extraer Datos de bebidas 
                                while ($regMarca = mysqli_fetch_assoc($marcas_productos)) {
                                    echo "<tr>" .
                                        "<td>" .  $regMarca["id_marca"] . "</td>" .
                                        "<td>" .  $regMarca["nombre_marca"] . "</td>" .
                                        "</tr>";
                                }
                                ?>
                            </table>
                        </div>
                    </div>
                    <div class="col">
                        <div class="table-responsive">
                            <table class="col col-md-4 table text-light bg-dark" class="text-center">
                                <thead>
                                    <tr class=" col col-md-0.9">
                                        <th scope="col">Codigo</th>
                                        <th scope="col">Nombre Categoria</th>
                                    </tr>
                                </thead>
                                <?php
                                include("conexion/conexion.php");
                                //$consulta = "SELECT * FROM productos WHERE estatus = '1'";
                                $consulta = "SELECT categoria_de_productos.id_categoria, categoria_de_productos.nombre_categoria FROM categoria_de_productos";

                                $categorias_productos = mysqli_query($conectar, $consulta);
                                //Extraer Datos de bebidas 
                                while ($regCatego = mysqli_fetch_assoc($categorias_productos)) {
                                    echo "<tr>" .
                                        "<td>" .  $regCatego["id_categoria"] . "</td>" .
                                        "<td>" .  $regCatego["nombre_categoria"] . "</td>" .
                                        "</tr>";
                                }
                                ?>
                            </table>
                        </div>
                    </div>
                    <div class="col">
                        <table class="col col-md-4 table text-light bg-dark" class="text-center">
                            <thead>
                                <tr class=" col col-md-0.9">
                                    <th scope="col">Codigo</th>
                                    <th scope="col">Tipo presentacion</th>
                                </tr>
                            </thead>
                            <?php
                            include("conexion/conexion.php");
                            //$consulta = "SELECT * FROM productos WHERE estatus = '1'";
                            $consulta = "SELECT presentacion_productos.id_presentacion, presentacion_productos.tipo_presentacion FROM presentacion_productos";

                            $presentaciones_productos = mysqli_query($conectar, $consulta);
                            //Extraer Datos de bebidas 
                            while ($regPresentacion = mysqli_fetch_assoc($presentaciones_productos)) {
                                echo "<tr>" .
                                    "<td>" .  $regPresentacion["id_presentacion"] . "</td>" .
                                    "<td>" .  $regPresentacion["tipo_presentacion"] . "</td>" .
                                    "</tr>";
                            }
                            ?>
                        </table>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <style>
        body {
            background-color: #000000
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var inputs = document.querySelectorAll('input[type="text"]');

            inputs.forEach(function(input) {
                input.addEventListener('input', function() {
                    var value = this.value.trim();

                    // Reemplazar doble espacio por espacio único
                    value = value.replace(/\s{2,}/g, ' ');

                    // Convertir texto a mayúsculas
                    value = value.toUpperCase();

                    // Asignar el nuevo valor al campo de texto
                    this.value = value;
                });
            });
        });
    </script>

    <script src="js/bootstrap.bundle.min.js"></script>
</body>

</html>
