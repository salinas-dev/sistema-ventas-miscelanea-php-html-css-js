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
      background-color: #000000;
    }
  </style>
  
  <main class="container">
    <section class="row">
      <!-- ICONO CON ENLACE HACIA LA GESTION DE PRODUCTOS -->
      <article class="col col-md-2.4 bg-dark text-bg-primary p-4 text-center">
        <a class="icon-link" href="gestion-productos.php" target="iframe_de_productos" id="mostrar_pag" onclick="mostrar('iframe_de_productos')">
          <span class="border border-white">
            <img title="Gestion de Productos" src="img/gestionProductos.png" width="80px" height="75px">
          </span>
          <svg class="bi" aria-hidden="true"><use xlink:href="#box-seam"></use></svg>
        </a>
        <div><p>Gestion de Productos</p></div>
      </article>
      <!-- ICONO CON ENLACE HACIA INVENTARIO -->
      <article class="col col-md-2.4 bg-dark text-bg-primary p-3 text-center">
        <a class="icon-link" href="./inventario.php" target="iframe_de_inventario" onclick="mostrar('iframe_de_inventario')">
          <span class="border border-white">
            <img title="Gestion de Productos" src="img/inventario.png" width="80px" height="85px">
          </span>
          <svg class="bi" aria-hidden="true"><use xlink:href="#box-seam"></use></svg>
        </a>
        <div><p>Inventario</p></div>
      </article>
      <!-- ICONO CON ENLACE HACIA GESTION DE VENTAS -->
      <article class="col col-md-2.4 bg-dark text-bg-primary p-3 text-center">
        <a class="icon-link" href="./vender.php" target="iframe_de_ventas" onclick="mostrar('iframe_de_ventas')">
          <span class="border border-white">
            <img title="Gestion de Productos" src="img/gestionVenta.png" width="80px" height="85px">
          </span>
          <svg class="bi" aria-hidden="true"><use xlink:href="#box-seam"></use></svg>
        </a>
        <div><p>Gestion de Ventas</p></div>
      </article>
      <!-- ICONO CON ENLACE HACIA REPORTES DE VENTAS -->
      <article class="col col-md-2.4 bg-dark text-bg-primary p-3 text-center">
        <a class="icon-link" href="./ventas.php" target="iframe_de_reportes" onclick="mostrar('iframe_de_reportes')">
          <span class="border border-white">
            <img title="Gestion de Productos" src="img/reporteventas.png" width="80px" height="85px">
          </span>
          <svg class="bi" aria-hidden="true"><use xlink:href="#box-seam"></use></svg>
        </a>
        <div><p>Reportes de Ventas</p></div>
      </article>


      <!-- ICONO CON ENLACE HACIA CONFIGURACION -->
      <article class="col col-md-2.4 bg-dark text-bg-primary p-3 text-center">
        <a class="icon-link" href="configuracion.php">
          <span class="border border-white">
            <img title="Gestion de Productos" src="img/configuraciones.png" width="80px" height="85px">
          </span>
          <svg class="bi" aria-hidden="true"><use xlink:href="#box-seam"></use></svg>
        </a>
        <div><p>Configuracion</p></div>
        
      </article>

      <hr size="10px" color="#FFFFFF" />
      <!-- AQUI IRA IMPLEMENTADO UN IFRAME PARA MOSTRAR LA PARTE DE GESTION DE PRODUCTOS -->
      <iframe src="gestion-productos.php" frameborder="3" name="iframe_de_productos" width="900px" height="500px" class="gestion" id="iframe_de_productos"></iframe>
      <!-- IFRAME PARA MOSTRAR LA PARTE DE INVENTARIO -->
      <iframe src="inventario.php" frameborder="3" name="iframe_de_inventario" width="900px" height="500px" class="gestion" id="iframe_de_inventario"></iframe>
      <!-- IFRAME PARA MOSTRAR LA PARTE DE GESTION DE VENTAS -->
      <iframe src="vender.php" frameborder="3" name="iframe_de_ventas" width="900px" height="500px" class="gestion" id="iframe_de_ventas"></iframe>
      <!-- IFRAME PARA MOSTRAR LA PARTE DE REPORTES DE VENTAS -->
      <iframe src="ventas.php" frameborder="3" name="iframe_de_reportes" width="900px" height="500px" class="gestion" id="iframe_de_reportes"></iframe>
      <!-- IFRAME PARA MOSTRAR LA PARTE DE CONFIGURACION -->
      <iframe src="configuracion.php" frameborder="3" name="iframe_de_configuracion" width="900px" height="500px" class="gestion" id="iframe_de_configuracion"></iframe>
    </section>
  </main>

  <style>
    .gestion {
      display: none;
    }
  </style>

  <script>
    function mostrar(iframeId) {
      const iframes = document.querySelectorAll('.gestion');
      iframes.forEach(iframe => {
        iframe.style.display = 'none';
      });
      document.getElementById(iframeId).style.display = 'block';
    }
  </script>

  <script src="js/bootstrap.bundle.min.js"></script>
</body>
</html>
