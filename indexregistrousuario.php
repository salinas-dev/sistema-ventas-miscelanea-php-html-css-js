<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">

<body>
  <script src="js/bootstrap.bundle.min.js"></script>

  <main class="container" id="contenedor">

    <body class="body bg-dark mb-8 pt-5 ">
      <header class="header bg-dark">
        <h1></h1>
      </header>
      <section class="row bg-white" id="section">
       
        <form action="registrar-usuario.php" method="post">
          <div class="row">
            <header class="header text-center">
              <h1> Registrar usuario </h1>
            </header>
          <!-- Nuestro articulo donde estaran la caja de texto-->
          <div class="form-floating col-12 col-sm-6 col-md-6 col-lg-6 col-xl-6 col-xxl-4 mb-2">
            <input type="text" class="form-control" placeholder="nombre" name="txtnombre">
            <label for="floatingInput">Nombre</label>
          </div>
        
          <!-- Nuestro articulo donde estaran la caja de texto-->
          <div class="form-floating col-12 col-sm-6 col-md-6 col-lg-6 col-xl-6 col-xxl-4 mb-2">
            <input type="text" class="form-control" placeholder="Apellido Paterno" name="txtapellido1">
            <label for="floatingInput">Apellido Paterno</label>
        </div>
          <!-- Nuestro articulo donde estaran la caja de texto-->
          <div class="form-floating col-12 col-sm-6 col-md-6 col-lg-6 col-xl-6 col-xxl-4 mb-2">
            <input type="text" class="form-control" placeholder="Apellido Materno" name="txtapellido2">
            <label for="floatingInput">Apellido Materno</label>
          </div>

          <!-- Nuestro articulo donde estaran la caja de texto-->
          <div class="form-floating col-12 col-sm-6 col-md-6 col-lg-6 col-xl-6 col-xxl-4 mb-2">
            <input type="text" class="form-control" placeholder="name@example.com" name="txtemail">
            <label for="floatingInput">Email</label>
          </div>

          <!-- Nuestro articulo donde estaran la caja de texto-->
          <div class="form-floating col-12 col-sm-6 col-md-6 col-lg-6 col-xl-6 col-xxl-4 mb-2">
            <input type="text" class="form-control" placeholder="usuario" name="txtusuario">
            <label for="floatingInput">Usuario</label>
          </div>

          <!-- Nuestro articulo donde estaran la caja de texto-->
          <div class="form-floating col-12 col-sm-6 col-md-6 col-lg-6 col-xl-6 col-xxl-4 mb-2">
            <input type="password" class="form-control" id="floatingPassword" placeholder="Password" name="txtcontraseña">
            <label for="floatingPassword">Contraseña</label>
          </div>
          <!-- Nuestro div donde esta nuestro button-->
          <div class="d-grid form-floating col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 mb-2">
            <button class="btn btn-lg btn-warning btn-login fw-bold mb-2 " type="submit">Registrar</button>

          <!-- Nuestro div donde nos redirecciona a nuestra pagina index.html-->
          <!-- text-uppercase: Pone el texto en mayusculas-->
          <!-- mb-2: para clases que establecen margin-bottom o padding-bottom-->
          <div class="text-center d-grid form-floating col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 mb-2 d-grid">
               <!-- fw-bold: Pone el texto en mayusculas-->
              <a class="btn btn-warning small fw-bold" href="indexlogin.php">Iniciar sesión</a>
            </div>
            </div>
          </div>
        </form>
      </section>
    </body>
  </main>
 
</body>

</html>
