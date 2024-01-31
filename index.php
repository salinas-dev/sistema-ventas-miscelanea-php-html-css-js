<?php
  //Inicio de sesion 
  session_start();

?>
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
          <h1>Inicio de sesion</h1>
        </header>
        <header class="text-white text-center">
          <h6>Por favor inicia tu sesion en caso de no <br> tener cuenta crea una</h6>
        </header>
        
         <!-- Nuestro Form para validar -->
        <form action="validar.php" method="post">
          <div class="div1 form-floating mb-3">
            <input type="text" class="form-control" placeholder="name@example.com" name="usuario">
            <label for="floatingInput">Usuario</label>
          </div>
          <div class="form-floating mb-3">
            <input type="password" class="form-control" id="floatingPassword" placeholder="Password" name="contraseña">
            <label for="floatingPassword">Contraseña</label>
          </div>

          <div class="d-grid">
            <button class="btn btn-lg btn-warning btn-login text-uppercase fw-bold mb-2" type="submit">Entrar</button>
            <!-- <div class="text-center">
              <a class="small text-white" href="indexadministrador.php">Registrate aqui!</a>
            </div> -->
          </div>
        </form>
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