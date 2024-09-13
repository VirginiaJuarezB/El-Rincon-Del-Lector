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

//Aquí recibimos la información del formulario a través del cual el administrador puede modificar los registros.


include 'BookManager.php';

$register = new BookManager;

$BookID = $_POST['BookID'];
$title = $_POST['title'];
$author = $_POST['author'];
$genre = $_POST['genre'];
$CatID = $_POST['category'];
$user = $_POST['user'];



    if (empty($BookID) || empty($title) || empty($author) || empty($genre) || empty($CatID) || empty($user)) {
        
        echo "Rellena bien todos los campos. Pulsa <a href='data.php'>Aquí</a> para volver a intentarlo.";
    } else {

        $register->editBookSAdmin($BookID, $title, $author, $genre, $CatID, $user);

        header("Location: data.php");
        exit();
        
    }
     


?>

</body>
</html>