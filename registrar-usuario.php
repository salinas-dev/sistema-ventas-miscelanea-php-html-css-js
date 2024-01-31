<?php
    include("conexion/conexion.php");
    $nombre = $_POST['txtnombre'];
    $apellido1 = $_POST['txtapellido1'];
    $apellido2 = $_POST['txtapellido2'];
    $email = $_POST['txtemail'];
    $usuario = $_POST['txtusuario'];
    $contraseña = $_POST['txtcontraseña'];

    $consulta = "CALL insertarUsuario('$nombre','$apellido1','$apellido2','$email','$usuario','$contraseña')";

    if(mysqli_query($conectar,$consulta)){
        #DEDIRENCIONA A INSUMO PLATILLO
        header("location:indexregistrousuario.php");
    }else{
        echo "PROBLEMAS AL REGISTRAR AL USUARIO";
        
    }
    #echo "$platillo - $insumo - $cantidad";
?>