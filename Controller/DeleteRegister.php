<?php
//Aquí recibimos la información para borrar un registro desde la estantería del usuario

include 'BookManager.php';

$register = new BookManager;

$BookID = $_POST['BookID'];

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$userID = $_SESSION['user'];

$register-> removeBook($BookID, $userID);

header("Location: ../View/bookShelf.php");
exit();

?>