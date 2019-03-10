<?php

function mostrarError($errores , $campo){
    $alerta='';
    if(isset($errores[$campo]) && !empty($campo)){
        $alerta = "<div class='alerta alerta-error'>".$errores[$campo].'</div>';
    }
    return $alerta;
}

function borrarErrores(){
    $borrado = false;

    if(isset($_SESSION['errores'])){
        unset($_SESSION['errores']);

    }


    if(isset($_SESSION['completado'])){
        unset($_SESSION['completado']);

    }

    if(isset($_SESSION['errores_entrada'])){
        unset($_SESSION['errores_entrada']);

    }

    return $borrado;

}

function conseguirCategorias($conexion){
    $sql = "SELECT * FROM categorias ORDER BY id ASC";
    $categorias= mysqli_query($conexion,$sql);
    
    $resultado = array();
    if($categorias && mysqli_num_rows($categorias) >=1){
        $resultado = $categorias;

    }
    return $resultado;

}

function conseguirCategoria($conexion,$id){
    $sql = "SELECT * FROM categorias WHERE id =$id";
    $categorias= mysqli_query($conexion,$sql);
    
    $resultado = array();
    if($categorias && mysqli_num_rows($categorias) >=1){
        $resultado = mysqli_fetch_assoc($categorias);

    }
    return $resultado;

}
function conseguirEntradas($conexion,$limit = null , $categoria=null , $busqueda = null){
    
    if($limit){
        $sql=" SELECT  e.* , c.nombre AS 'categoria'  FROM  entradas e INNER JOIN categorias c ON e.categoria_id = c.id ORDER BY e.id DESC LIMIT 4";
    }else{
        $sql = "SELECT  e.* , c.nombre AS 'categoria'  FROM  entradas e INNER JOIN categorias c ON e.categoria_id = c.id ORDER BY e.id DESC";
    }
    if(!empty($busqueda)){
        $sql="SELECT  e.* , c.nombre AS 'categoria'  FROM  entradas e INNER JOIN categorias c ON e.categoria_id = c.id  WHERE e.titulo LIKE '%$busqueda%'  ORDER BY e.id DESC";

    }
    if(!empty($categoria)){
        $sql="SELECT  e.* , c.nombre AS 'categoria'  FROM  entradas e INNER JOIN categorias c ON e.categoria_id = c.id  WHERE e.categoria_id = $categoria  ORDER BY e.id DESC";
    }


    $entradas = mysqli_query($conexion,$sql);

    $resultado = array();
    if($entradas && mysqli_num_rows($entradas)>=1){
        $resultado = $entradas;
    }
    return $entradas;

}

function conseguirEntrada($conexion,$id){
    $sql = "SELECT e.* ,c.nombre AS 'categoria', CONCAT(u.nombre, ' ',u.apellido) AS usuario FROM entradas  AS e  INNER JOIN categorias c ON e.categoria_id = c.id  INNER JOIN usuarios u ON e.usuario_id = u.id WHERE e.id =$id ";
    $entrada= mysqli_query($conexion,$sql);
    $resultado = array();
    if($entrada && mysqli_num_rows($entrada) >=1){
        $resultado = mysqli_fetch_assoc($entrada);

    }
    return $resultado;

}

function conseguirTodaslasEntradas($conexion){
    $sql = "SELECT  e.* , c.nombre AS 'categoria'  FROM  entradas e INNER JOIN categorias c ON e.categoria_id = c.id ORDER BY e.id";
    $entradas = mysqli_query($conexion,$sql);

    $resultado = array();
    if($entradas && mysqli_num_rows($entradas)>=1){
        $resultado = $entradas;
    }
    return $entradas;

}


?>