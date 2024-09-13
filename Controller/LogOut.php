<?php

//Aquí recibimos la información del botón "cerrar sesión". 
include 'BookManager.php';

$bookManager = new BookManager;

$logout = $_POST['logout'];

$bookManager->logout($logout);

header("location: ../index.php");
exit;

?>