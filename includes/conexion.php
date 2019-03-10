<?php 
//Conexion
$servidor = 'localhost';
$usuario = 'root';
$password = '';
$basededatos = 'blog_master';
$db = mysqli_connect($servidor, $usuario, $password, $basededatos);

mysqli_query($db,"SET NAMES 'utf-8'");

// INICIAR LA SESION
if(!isset($_SESSION)){
    session_start();
}


?>