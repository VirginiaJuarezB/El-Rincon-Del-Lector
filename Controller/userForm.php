<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8" />
    <meta name="description" content="El rincon del lector" />
    <link rel="icon" type="favicon/x-icon" href="img/favicon.png"/>
    <link rel="stylesheet" type="text/css" href="styles.css"/>
    <title>El rincón del lector</title>
  </head>
  <body>

  <div id="userMessage">

<?php

//Aquí recibimos la información del formulario de inicio de sesión. 

include 'BookManager.php';

$bookManager = new BookManager;


session_start();


if (isset($_SESSION['user'])) {
    
    $bookManager->setUserID($_SESSION['user']);
}


if (isset($_POST['enviar'])) {
    $user = $_POST['user'];
    $password = $_POST['password'];
    $bookManager->login($user, $password);
}

?>

</div>

</body>
</html>
