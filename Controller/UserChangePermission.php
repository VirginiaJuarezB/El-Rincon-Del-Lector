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

<?php
//Aquí recibimos la información del formulario por el cual el administrador puede cambiar los permisos de usuario. 

include 'BookManager.php';

$bookManager = new BookManager;

$UserID = $_POST['UserID'];
$permission = $_POST['permission'];



if (empty($UserID) || empty($permission)) {
        
    echo "Rellena bien todos los campos. Pulsa <a href='data.php'>Aquí</a> para volver a intentarlo.";
} else {

    $bookManager->changeUser($UserID, $permission);

    header("Location: data.php");
    exit();
    
    
}

?>

</body>
</html>