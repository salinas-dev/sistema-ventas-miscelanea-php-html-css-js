<?php 
session_start();
if(!isset($_SESSION["carrito"])) $_SESSION["carrito"] = [];
$granTotal = 0;
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Gestion de ventas</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
<link rel="shortcut icon" href="img/iconolanueva.png">
</head>
<body >


<style>
      body {
      background-color: #000000
      }
      </style>



<h1 style="color: white" class="text-center">Gestión de ventas</h1>
<div class="container container-sm container-md container-lg container-xl container-xxl">
    <div class="row">
        <div class="col-xs-12">
	<?php
		if(isset($_GET["status"])){
			if($_GET["status"] === "1"){
	?>
	<div class="alert alert-success">
		<strong>¡Correcto!</strong> Venta realizada correctamente
	</div>
	<?php
			}else if($_GET["status"] === "2"){
	?>
	<div class="alert alert-info">
		<strong>Venta cancelada</strong>
	</div>
	<?php
			}else if($_GET["status"] === "3"){
	?>
	<div class="alert alert-info">
		<strong>Ok</strong> Producto quitado de la lista
	</div>
	<?php
			}else if($_GET["status"] === "4"){
	?>
	<div class="alert alert-warning">
		<strong>Error:</strong> El producto que buscas no existe
	</div>
	<?php
			}else if($_GET["status"] === "5"){
	?>
	<div class="alert alert-danger">
		<strong>Error: </strong>El producto está agotado
	</div>
	<?php
			}else{
	?>
	<div class="alert alert-danger">
		<strong>Error:</strong> Algo salió mal mientras se realizaba la venta
	</div>
	<?php
			}
		}
	?>
	
<br>
<form method="post" action="agregarAlCarrito.php">
    <label style="color: white; font-size: 20px;" for="id_producto">Código de barras:</label>
    <input style="font-size: 16px;" autofocus class="form-control" name="id_producto" required type="text" id="id_producto" placeholder="Escribe o escanea el código">
</form>
<br><br>
<div class="table-responsive">
    <table class="table table-bordered">
        <thead>
        <tr style="background-color: #333; color: white; font-size: 16px;">
                <th>Codigo de Barras</th>
                <th>Nombre</th>
                <th>Descripción</th>
				<th>Costo unitario</th>
                <th>Precio de venta</th>
                <th>Cantidad</th>
                <th>Total</th>
                <th>Quitar</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($_SESSION["carrito"] as $indice => $producto) {
                $granTotal += $producto->total;
            ?>
                        <tr style="background-color: #333; color: white"; class="text-center">
                    <td><?php echo $producto->id_producto ?></td>
                    <td><?php echo $producto->nombre ?></td>
                    <td><?php echo $producto->descripcion ?></td>
					<td><?php echo $producto->costo_urinario ?></td>
                    <td><?php echo $producto->precio_venta ?></td>
                    <td><?php echo $producto->cantidad ?></td>
                    <td><?php echo $producto->total ?></td>
                    <td><a class="btn btn-danger" href="<?php echo "quitarDelCarrito.php?indice=" . $indice ?>"><i class="fa fa-trash"></i></a></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

    <h3 style="color: white">Total: $ <?php echo $granTotal; ?></h3>
    <form action="./terminarVenta.php" method="POST">
        <input name="total" type="hidden" value="<?php echo $granTotal; ?>">
        <button type="submit" style="font-size: 16px;" class="btn btn-success">Terminar venta</button>
        <a href="./cancelarVenta.php" style="font-size: 16px;" class="btn btn-danger">Cancelar venta</a>
    </form>
</div>
</div>
</div>

<div class="table-responsive">
        <?php if (!empty($_SESSION["carrito"])) { ?>
            <table class="table table-bordered">
                <!-- Código de la tabla -->
            </table>
            <h3 style="color: white">Total: $ <?php echo $granTotal; ?></h3>
            <form action="./terminarVenta.php" method="POST">
                <!-- Resto del código del formulario -->
            </form>
        <?php } else { ?>
            <div style="font-size: 16px;" class="alert alert-info">
                <strong>No hay productos en el carrito.</strong>
            </div>
        <?php } ?>
    </div>
<!---
	<script>
	  // Obtener referencia al campo de entrada
	  var codigoInput = document.getElementById('codigo');
					
	  // Agregar un evento al presionar una tecla en el campo de entrada
	  codigoInput.addEventListener('keydown', function(e) {
	    // Verificar si se presionó la tecla Enter (código 13)
	    if (e.keyCode === 13) {
	      e.preventDefault(); // Evitar el envío del formulario
		
	      // Llamar a la función para escanear el código de barras
	      scanBarcode();
	    }
	  });
  
	  // Función para escanear el código de barras utilizando ZXing
	  function scanBarcode() {
	  // Crear un objeto del escáner
	  const codeReader = new ZXing.BrowserBarcodeReader();
	
	  // Escanear el código de barras
	  codeReader
	      .decodeFromInputVideoDevice(undefined, 'video')
	      .then(result => {
	        // Mostrar el código de barras escaneado en el campo de entrada
	        codigoInput.value = result.text;
	      })
	      .catch(err => {
	        console.error(err);
	      });
	  }
	</script>
--->
	<script src="https://unpkg.com/@zxing/library@latest"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</body>
</html>
