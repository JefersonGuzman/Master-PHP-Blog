<?php
    //CONEXION A LA BASE DE DATOS
    if(isset($_POST)){
        session_start();
        require_once 'includes/conexion.php';
        //RECOGER LOS VALORES DEL FORMULARIO DE REGISTRO 
        $nombre = isset($_POST['nombre']) ? mysqli_real_escape_string($db, $_POST['nombre']) : false;
        $apellido = isset($_POST['apellido'])? mysqli_real_escape_string($db, $_POST['apellido']) : false;
        $email = isset($_POST['email'])? mysqli_real_escape_string($db,trim($_POST['email'])) : false;
        $password = isset($_POST['password'])? mysqli_real_escape_string($db, $_POST['password']) : false;
        
        //Array de Errores
        $errores=Array();


        //VALIDAR LOS DATOS ANTES DE GUARDARLOS EN LA BASE DE DATOS

        //Validar campo Nombre
        if(!empty($nombre) && !is_numeric($nombre) && !preg_match("/[0-9]/", $nombre)){
            $nombre_validado=true;
        }else{
            $nombre_validado=false;
            $errores['nombre']="El nombre no es valido";
        }
        //Validar Compo Apellido
        if(!empty($apellido) && !is_numeric($apellido) && !preg_match("/[0-9]/", $apellido)){
            $apellido_validado=true;
        }else{
            $apellido_validado=false;
            $errores['apellido']="El apellido no es valido";
        }
        //Validar el email
        if(!empty($email) && filter_var($email.FILTER_VALIDATE_EMAIL)){
            $email_validado=true;
        }else{
            $email_validado=false;
            $errores['email']="El email no es valido";
        }
        //Validar el Password
        if(!empty($password)){
            $password_validado=true;
        }else{
            $password_validado=false;
            $errores['password']="la password Esta vacia";
           
        }
        $guardar_usuario=false;

        if(count($errores) == 0){
        $guardar_usuario=true;
        
            //Cifrar contraseña

            $password_segura = password_hash($password , PASSWORD_BCRYPT , ['cost =>4']);


            //INSERTAR USUARIO EN LA BASE DE DATOS EN AL TABLA CORRESPONDIENTE
         
            $sql = "INSERT INTO usuarios VALUES (null,'$nombre','$apellido','$email','$password_segura',CURDATE());";
            $guardar=mysqli_query($db , $sql);
            if($guardar){
                $_SESSION['completado'] = "El registro se ha completado con éxito";
            }else{
                $_SESSION['errores'] ['general'] = "Fallo al guardar el Usuario !!";
            }

            }else{
                //NO SE REGISTRA A EL USUARIO Y MOSTRARIAMOS EL ERROR
                $_SESSION['errores'] = $errores;

            }


    }

    header('location:index.php');


?>