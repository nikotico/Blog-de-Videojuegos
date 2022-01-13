<?php

if(isset($_POST)){

    //Carga la conexion a la base de datos
    require_once 'includes/conexion.php';

    //Recoger los valores del formulario de actualizacion
    $nombre = isset($_POST['name']) ? mysqli_real_escape_string($db, $_POST['name'] ) : false ;//El escapar datos en un arma de doble filo ya 
    //que un nombre puedo tener caracteres que son del lenguajes, pero no son parte de un nombre real

    $apellidos = isset($_POST['lastname']) ? mysqli_real_escape_string($db, $_POST['lastname']) : false;

    $email =isset($_POST['email']) ? mysqli_real_escape_string($db, trim( $_POST['email']) ) : false;

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

    $usuario_guardado = false;

    if(empty($errores)){
        $usuario = $_SESSION['usuario'];
		$guardar_usuario = true;
		
		// COMPROBAR SI EL EMAIL YA EXISTE
		$sql = "SELECT id, email FROM usuarios WHERE email = '$email'";
		$isset_email = mysqli_query($db, $sql);
		$isset_user = mysqli_fetch_assoc($isset_email);
		
		if($isset_user['id'] == $usuario['id'] || empty($isset_user)){
			// ACTULIZAR USUARIO EN LA TABLA USUARIOS DE LA BBDD
			
			$sql = "UPDATE usuarios SET ".
				   "nombre = '$nombre', ".
				   "apellidos = '$apellidos', ".
				   "email = '$email' ".
				   "WHERE id = ".$usuario['id'];
			$guardar = mysqli_query($db, $sql);


			if($guardar){
				$_SESSION['usuario']['nombre'] = $nombre;
				$_SESSION['usuario']['apellidos'] = $apellidos;
				$_SESSION['usuario']['email'] = $email;

				$_SESSION['completado'] = "Tus datos se han actualizado con éxito";
			}else{
				$_SESSION['errores']['general'] = "Fallo al guardar el actulizar tus datos!!";
			}
		}else{
			$_SESSION['errores']['general'] = "El usuario ya existe!!";
		}
		
	}else{
		$_SESSION['errores'] = $errores;
	}
}

header('Location: mis-datos.php');
 