<?php

if(isset($_POST)){

    //Carga la conexion a la base de datos
    require_once 'includes/conexion.php';

    //Recoger los valores del formulario de categoria
    $titulo = isset($_POST['titulo']) ? mysqli_real_escape_string($db, $_POST['titulo'] ) : false ;//El escapar datos en un arma de doble filo ya 
    //que un nombre puedo tener caracteres que son del lenguajes, pero no son parte de un nombre real

    $descripcion = isset($_POST['descripcion']) ? mysqli_real_escape_string($db, $_POST['descripcion'] ) : false ;

    $categoria = isset($_POST['categoria']) ? (int)$_POST['categoria'] : false ;

    $usuario = $_SESSION['usuario']['id'];

    $errores = array();

        //Validar antes de guardar

    //Validar nombre
    if(empty($titulo) ){
        $errores['titulo'] = 'El nombre no es valido';
    }

    //Validar description
    if(empty($descripcion)){
        $errores['descripcion'] = 'La descripcion no es valida';
    }

    if(empty($categoria) && !is_numeric($categoria)){
        $errores['categoria'] = 'La categoria no es valida';
    }

    if(empty($errores)){
        if(isset($_GET['editar'])){
            $entrada_id = $_GET['editar'];
            $usuario_id = $_SESSION['usuario']['id'];

            $sql="UPDATE entradas SET 
            titulo ='$titulo',
            descripcion = '$descripcion',
            categoria_id = $categoria
            WHERE id = $entrada_id AND usuario_id = $usuario_id";

        }else{
            //Insert
            $sql="INSERT INTO entradas VALUES (null,$usuario,$categoria,'$titulo','$descripcion',CURDATE());";
        }
        $guardar = mysqli_query($db,$sql);
        
        header('Location: index.php');
    }else{
        $_SESSION['errores_entrada'] = $errores;
        if(isset($_GET['editar'])){
            header("Location: editar-entrada.php?id=".$_GET['editar']);
        }else{
            header("Location: crear-entradas.php");
        }
    }
}