<?php

//Aquí recibimos la información del formulario por el cual se puede registrar un posible usuario.

include 'BookManager.php';

$newUser = new BookManager;
$user=$_POST['user'];
$password=$_POST['password'];
$email=$_POST['email'];

if (isset($_POST['enviar'])){

    $newUser->checkExistingUser($email, $password, $user);

}

?>