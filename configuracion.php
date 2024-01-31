<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
  <link rel="shortcut icon" href="img/iconolanueva.png">
</head>

<body class="body bg-dark">
  <!--class = "text-center" centra el contenido-->
  <script src="js/bootstrap.bundle.min.js"></script>
  <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script> -->

  <main class="container" id="contenedor">
    <section class="row body bg-dark mb-8 pt-5">

      <!-- Nuestro articulo donde estaran las cajas de texto-->
      <article class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6 col-xxl-4 mb-2" id="contenedorTexto" place-content-center>


        <!-- Nuestro Header donde esta nuestro encabezado-->
        <header class="text-white text-center">
          <h1>Configuracion</h1>
        </header>
      <center>
      <a class="btn btn-lg btn-warning btn-login text-uppercase fw-bold mb-2" href="#" id="cancelarBtn" onclick="window.history.back();">Regresar</a>
      <a class="btn btn-lg btn-warning btn-login text-uppercase fw-bold mb-2" href="index.php">Salir</a>
      
    </center> 
    </article>


      <!-- Nuestro article donde estara nuestra imagen -->
      <article class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6 col-xxl-4 mb-2" id="contenedorImagen">
        <!-- style="width: 100%  propiedad para que la imagen no se vea pixeleada -->
        <p style="text-align:center;"><img class="logo" style="width: 100%;" src="img/logo.png" alt="">

      </article>
    </section>
  </main>
</body>
</html>