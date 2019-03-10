<?php
//iniciar la sesion  y la conexion a bd
require_once 'includes/conexion.php';

//Recoger datos del formulario

if(isset($_POST)){

    //Borrar Error Antiguo
    if(isset($_SESSION['error_login'])){
        unset($_SESSION['error_login']);
    }

    //Recorrer Datos de Formulario
    $email = trim($_POST['email']);
    $password=$_POST['password'];

    //Consulta para comprobar las credenciales del usuario
    $sql="SELECT * FROM usuarios WHERE email = '$email'";
    $login=mysqli_query($db,$sql);


    if($login && mysqli_num_rows($login)==1){
        $usuario = mysqli_fetch_assoc($login);
        //Comprobar la contraseña
        $verify = password_verify($password,$usuario['password']);

        if($verify){
            //Utilizar una sesion para guardar los datos del usuario logueado
            $_SESSION['usuario'] = $usuario;

        }else{
            //Si algo falla enviar una sesion con el fallo 
            $_SESSION['error_login']="Login incorrecto";
        }
    }else{
        //Mensaje de Error
        $_SESSION['error_login']="Login incorrecto";

    }


    
}

//Redirigir al index.php

header('Location:index.php');





?>