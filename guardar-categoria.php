<?php

if(isset($_POST)){

    //Carga la conexion a la base de datos
    require_once 'includes/conexion.php';

    //Recoger los valores del formulario de categoria
    $nombre = isset($_POST['nombre']) ? mysqli_real_escape_string($db, $_POST['nombre'] ) : false ;//El escapar datos en un arma de doble filo ya 
    //que un nombre puedo tener caracteres que son del lenguajes, pero no son parte de un nombre real


    $errores = array();

        //Validar antes de guardar

    //Validar nombre
    if(!empty($nombre) && !is_numeric($nombre) && !preg_match("/[0-9]/",$nombre) ){
        $nombre_validate = true;
    }else{
        $nombre_validate = false;
        $errores['nombre'] = 'El nombre no es valido';
    }

    if(empty($errores)){
        //Insert
        $sql="INSERT INTO categorias VALUES (null,'$nombre');";
        $guardar = mysqli_query($db,$sql);
    }
}
header('Location: index.php');
