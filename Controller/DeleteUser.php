<?php

//Aquí recibimos la información para borrar un ususario desde el panel del administrador.

include 'BookManager.php';

$bookManager = new BookManager;

$UserID = $_POST['UserID'];

$bookManager->removeUser($UserID);

header("Location: data.php");
exit();

?>