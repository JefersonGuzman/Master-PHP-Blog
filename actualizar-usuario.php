<?php
    //CONEXION A LA BASE DE DATOS
    if(isset($_POST)){
        require_once 'includes/conexion.php';
        //RECOGER LOS VALORES DEL FORMULARIO DE ACTUALIZACION

        $nombre = isset($_POST['nombre']) ? mysqli_real_escape_string($db, $_POST['nombre']) : false;
        $apellido = isset($_POST['apellido'])? mysqli_real_escape_string($db, $_POST['apellido']) : false;
        $email = isset($_POST['email'])? mysqli_real_escape_string($db,trim($_POST['email'])) : false;
        
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

        $guardar_usuario=false;

        if(count($errores) == 0){
        $usuario = $_SESSION['usuario'];
        $guardar_usuario=true;
        
            //COMPROBAR SI EL EMAIL YA EXISTE

            $sql= "SELECT id , email FROM usuarios WHERE email ='$email'";
            $isset_email=mysqli_query($db,$sql);
            $isset_user=mysqli_fetch_assoc($isset_email);

            if($isset_user['id'] == $usuario['id'] || empty($isset_user)){
                //ACTUALIZAR USUARIO EN LA BASE DE DATOS EN AL TABLA CORRESPONDIENTE
                $sql = "UPDATE usuarios SET nombre ='$nombre',apellido = '$apellido',email='$email' WHERE id =".$usuario['id'];
                $guardar=mysqli_query($db , $sql);

                if($guardar){
                    $_SESSION['usuario']['nombre'] = $nombre;
                    $_SESSION['usuario']['apellido'] =$apellido;
                    $_SESSION['usuario']['email'] =$email;
                    $_SESSION['completado'] = "Tus datos se han actualizado con éxito";
                }else{

                    //NO SE REGISTRA A EL USUARIO Y MOSTRARIAMOS EL ERROR
                    $_SESSION['errores'] ['general'] = "Fallo al actualizar tus datos !!";
                }

                }else{
                    //ERROR CUANDO EL CORREO YA EXISTA EN AL BASE DE DATOS
                    $_SESSION['errores'] ['general'] = "Ya existe un usuadio con ese correo electronico !!";

                }
            }


    }

    header('location:mis-datos.php');


?>