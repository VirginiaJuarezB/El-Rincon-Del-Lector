<?php
//Aquí recibimos la información para borrar un registro desde el panel del Administrador.

include 'BookManager.php';

$register = new BookManager;

$BookID = $_POST['BookID'];

$register-> removeBookSuperAdmin($BookID);

header("Location: data.php");
exit();

?>