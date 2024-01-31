

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>La Nueva</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
  <link rel="shortcut icon" href="img/iconolanueva.png">

  <style>
    body {
      background-color: #000000;
    }
  </style>
</head>
<body>
  <p class="fw-bold text-light bg-dark">Agregar Productos</p>

  <form action="registar_producto.php" method="post" onsubmit="return validateForm()">
    <main class="container">
      <section class="row">
        <!--parte de donde se encuentra la caja de texto para poder ingresar un codigo -->
        <article class="col col-md-6 bg-dark text-bg-primary p-4">
          <label>Codigo Producto:</label>
          <input type="text" name="txtCodigo" class="input-group-text" oninput="trimInput(this)">
        </article>
        <!--parte de donde se encuentra la caja de texto para poder ingresar un Nombre -->
        <article class="col col-md-6 bg-dark text-bg-primary p-4">
          <label>Nombre Producto: </label>
          <input type="text" name="txtNombre" class="input-group-text" oninput="trimInput(this)">
        </article>
        <!--parte de donde se encuentra la caja de texto para poder ingresar una Descripcion -->
        <article class="col col-md-4 bg-dark text-bg-primary p-4">
          <label>Descripcion Producto:</label>
          <input type="text" name="txtDescripcion" class="input-group-text" oninput="trimInput(this)">
        </article>

        <!-- Usamos un etiqueta de tipo text -->
        <article class="col col-md-4 bg-dark text-bg-primary p-4">
          <label>Costo Unitario:</label>
          <input type="text" name="txtCostoUnitario" class="input-group-text" oninput="trimInput(this)">
        </article>
        <!-- Usamos un etiqueta de tipo text -->
        <article class="col col-md-4 bg-dark text-bg-primary p-4">
          <label>Precio Venta:</label>
          <input type="text" name="txtPrecioVenta" class="input-group-text" oninput="trimInput(this)">
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
              echo "<option value='" . $regMarca[1] . "'>" . $regMarca[1] . "</option>";
            }
            ?>
          </select>
        </article>

        <!-- SELECT para llenar el campo de categoria -->
        <article class="col col-md-2.4 bg-dark text-bg-primary p-4">
          <label>Categoria:</label>
          <select name="selectCategoria" class="form-select">
            <option value="">--Seleccione--</option>
            <?php
            include("conexion/conexion.php");
            $consulta = "SELECT id_categoria, nombre_categoria FROM categoria_de_productos;";
            $categoria = mysqli_query($conectar, $consulta);
            while ($regCategoria = mysqli_fetch_array($categoria)) {
              echo "<option value='" . $regCategoria[1] . "'>" . $regCategoria[1] . "</option>";
            }
            ?>
          </select>
        </article>

        <!-- SELECT para llenar el campo de presentacion -->
        <article class="col col-md-2.4 bg-dark text-bg-primary p-4">
          <label>Presentacion:</label>
          <select name="selectPresentacion" class="form-select">
            <option value="">--Seleccione--</option>
            <?php
            include("conexion/conexion.php");
            $consulta = "SELECT id_presentacion, tipo_presentacion FROM presentacion_productos;";
            $presentacion = mysqli_query($conectar, $consulta);
            while ($regPresentacion = mysqli_fetch_array($presentacion)) {
              echo "<option value='" . $regPresentacion[1] . "'>" . $regPresentacion[1] . "</option>";
            }
            ?>
          </select>
        </article>

        <!-- SELECT para llenar el campo de cantidad -->
        <article class="col col-md-4 bg-dark text-bg-primary p-4">
          <label>Cantidad:</label>
          <input type="text" name="txtCantidad" class="input-group-text" oninput="trimInput(this)">
          <!-- SELECT para llenar el campo de estatus con el valor por defecto 1 -->
          <input hidden type="text" name="txt_status" value="1">
        </article>

        <article class="col col-md-6 bg-dark text-bg-primary p-4">
          <button type="submit" class="btn btn-secondary">REGISTRAR PRODUCTO</button>
        </article>
        <article class="col col-md-6 bg-dark text-bg-primary p-4">
          <a class="btn btn-secondary" href="#" id="cancelarBtn" onclick="window.history.back();">Cancelar</a>
        </article>

        <article id="mensajeError" class="col col-md-12 bg-danger text-light p-4" style="display: none;">
          Por favor, complete todos los campos.
        </article>

      </section>
    </main>

    <script>
      function trimInput(element) {
        element.value = element.value.trim();
      }

      function validateForm() {
        var inputs = document.querySelectorAll('input[type="text"]');
        var isFormValid = true;

        for (var i = 0; i < inputs.length; i++) {
          if (inputs[i].value.trim() === '') {
            isFormValid = false;
            break;
          }
        }

        if (!isFormValid) {
          document.getElementById('mensajeError').style.display = 'block';
          return false;
        }

        return true;
      }
    </script>

    <script src="js/bootstrap.bundle.min.js"></script>
  </form>
</body>
</html>