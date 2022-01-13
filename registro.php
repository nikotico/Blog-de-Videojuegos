<?php

if(isset($_POST)){

    //Carga la conexion a la base de datos
    require_once 'includes/conexion.php';
    if(!isset($_SESSION)){
        session_start();
    }
    //Recoger los valores del formulario de registro
    $nombre = isset($_POST['name']) ? mysqli_real_escape_string($db, $_POST['name'] ) : false ;//El escapar datos en un arma de doble filo ya 
    //que un nombre puedo tener caracteres que son del lenguajes, pero no son parte de un nombre real

    $apellidos = isset($_POST['lastname']) ? mysqli_real_escape_string($db, $_POST['lastname']) : false;

    $email =isset($_POST['email']) ? mysqli_real_escape_string($db, trim( $_POST['email']) ) : false;

    $password = isset($_POST['password']) ? mysqli_real_escape_string($db, $_POST['password']) : false;

    //Array de errores
    $errores = array();

        //Validar antes de guardar

    //Validar nombre
    if(!empty($nombre) && !is_numeric($nombre) && !preg_match("/[0-9]/",$nombre) ){
        $nombre_validate = true;
    }else{
        $nombre_validate = false;
        $errores['nombre'] = 'El nombre no es valido';
    }

    //Validar apellidos
    if(!empty($apellidos) && !is_numeric($apellidos) && !preg_match("/[0-9]]/",$apellidos) ){
        $apellidos_validate = true;
    }else{
        $apellidos_validate = false;
        $errores['apellidos'] = 'El apellido no es valido';
    }

    //Validar email
    if(!empty($email) && filter_var($email,FILTER_VALIDATE_EMAIL)){
        $email_validate = true;
    }else{
        $email_validate = false;
        $errores['email'] = 'El email no es valido';
    }

    //Validar password
    if(!empty($password) ){
        $password_validate = true;
    }else{
        $password_validate = false;
        $errores['password'] = 'La contraseña esta vacia';
    }

    $usuario_guardado = false;

    if(empty($errores)){
        $usuario_guardado = true;
        
        //Cifrar contraseña
        $password_segura = password_hash($password, PASSWORD_BCRYPT,['cost'=>4]);

        //Insert
        $sql="INSERT INTO usuarios VALUES (null,'$nombre','$apellidos','$email','$password_segura',CURDATE() );";
        $guardar = mysqli_query($db,$sql);

        if($guardar){
            $_SESSION['completado'] = "Usuario guardado";
        }else{
            $_SESSION['errores']['general'] = "Fallo al guardar el usuario";
        }
    }else{
        $_SESSION['errores'] = $errores;
    }
}
header('Location: index.php');




?>