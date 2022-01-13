<?php

$server = "localhost";
$user = "root";
$password = '';
$datebase = 'blog';

$db = mysqli_connect($server, $user, $password, $datebase);

mysqli_query($db,"SET NAMES 'utf8'");

//Iniciar sesion
if(!isset($_SESSION)){
    session_start();
}

?>