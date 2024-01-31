<?php

$servidor = "localhost";
$usuario = "id20904610_userlanueva";
$contrasenia = "";
$baseDatos = "bd_lanueva";

$conectar = mysqli_connect(
                $servidor,
                $usuario,
                $contrasenia,
                $baseDatos) 
                OR DIE
                ("PROBLEMAS AL ENCONTRAR EL SERVIDOR");

              
//if($conectar){
  //echo "¡Conexion exitosa!";} else{
  //echo "Problemas al conectar con el servidor de datos";
//}
$contraseña = "";
$usuario = "id20904610_userlanueva";
$nombre_base_de_datos = "bd_lanueva";
try{
	$base_de_datos = new PDO('mysql:host=localhost;dbname=' . $nombre_base_de_datos, $usuario, $contraseña);
	$base_de_datos->query("set names utf8;");
    $base_de_datos->setAttribute(PDO::ATTR_EMULATE_PREPARES, FALSE);
    $base_de_datos->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $base_de_datos->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
}catch(Exception $e){
	echo "Ocurrió algo con la base de datos: " . $e->getMessage();
}
?>
