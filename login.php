    <?php

//Iniciar la sesion y la conexion con la db
require_once 'includes/conexion.php';
//Recoger datos del formulario
if(isset($_POST)){

    //Borrar error antiguio
    if(isset($_SESSION['error_login'])){
        unset($_SESSION['error_login']);
    }

    $email = trim($_POST['email']);
    $password = $_POST['password'];

    $sql = "Select * from usuarios WHERE email = '$email'";
    $login = mysqli_query($db,$sql);

    if($login && mysqli_num_rows($login) == 1){

        $user = mysqli_fetch_assoc($login);
        //Comprobar la contraseña
        if( password_verify($password,$user['password']) ){
            $_SESSION['usuario'] = $user;
            

        }else{
            $_SESSION['error_login'] = "Login incorrecto";
        }
    }else{
        $_SESSION['error_login'] = "Login incorrecto";
    }

}

header('Location: index.php');

?>
