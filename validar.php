<?php
include("conexion/conexion.php");
//Validar que los datos del login si esten en la BD y coincida el usuario con la contraseña
/*  if (userForm == $userBD && pwForm == pwBD){
    SI existen entonces iniciamos la sesion
    }
*/

//Obtenemos nuestros datos de nuestro index.php
session_start();

//Redireccione a index.php
header("index.php");
$usuario=$_POST['usuario'];
$contraseña=$_POST['contraseña'];
//Comenzando la sesión con session_start()

session_start();
//Si no se inicializa session_start, no existen las variable $_SESSION
$_SESSION['usuario']=$usuario;

//Hacemos una consulta 
$consulta="SELECT * FROM usuario WHERE usuario='$usuario' and contraseña = '$contraseña'";
//Va almacenar nuestra conexion
$resultado=mysqli_query($conectar,$consulta);
//Almacene el resultado para validar 
$filas=mysqli_num_rows($resultado);

if($filas)
    {
    #REDIRENCIONA A HOME
    header("location:indexhome.php");
}else{
    #Si no que nos redireccione 
    include("index.php");
    
    ?>
<div class="alert alert-danger" role="alert" >
<strong> Error en autotentificacion! </strong>
</div>

    <?php
}
mysqli_free_result($resultado);
mysqli_close($conectar);