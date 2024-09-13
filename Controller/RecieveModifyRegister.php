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

include 'BookManager.php';

//Aquí recibimos la información del formulario a través del cual los usuarios pueden modificar los registros.


$titleID = new BookManager;
$categoryID = new BookManager;

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$userID = $_SESSION['user'];

if(empty($_POST['title']) || empty($_POST['category'])) {
    echo "Faltan campos por rellenar. Pulsa <a href='../View/ModifyRegister.php'>Aquí</a> para volver a intentarlo. ";
} else {
    $title = $_POST['title'];
    $category = $_POST['category'];
    
    $bookID = $titleID->getBookID($title, $userID);

    if ($bookID) {
        $catID = $categoryID->getCatID($category);
        if ($catID) {
            $register = new BookManager;
            $register->editBook($bookID, $catID, $userID);
            header("Location: ../View/bookShelf.php");
            exit();
        } else {
            echo "La categoría proporcionada no existe. Pulsa <a href='../View/ModifyRegister.php'>Aquí</a> para volver a intentarlo.";
        }
    } else {
        echo "El libro no existe. Pulsa <a href='../View/ModifyRegister.php'>Aquí</a> para volver a intentarlo.";
    }
}

?>

</body>
</html>





