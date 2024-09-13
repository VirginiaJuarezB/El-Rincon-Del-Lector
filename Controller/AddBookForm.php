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

// Crear una instancia de la clase BookManager
$book = new BookManager;

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Verificar si los datos del formulario se han enviado
if (isset($_POST['enviar'])) {
    // Recuperar los datos del formulario
    $ftitle = $_POST['ftitle'];
    $fauthor = $_POST['fauthor'];
    $fgenre = $_POST['fgenre'];
    $category = $_POST['fcategory'];
    $userID = $_SESSION['user'];

    // Verificar si alguno de los campos está vacío
    if (empty($ftitle) || empty($fauthor) || empty($fgenre) || empty($category)) {
        echo "Por favor, complete todos los campos. Pulsa <a href='../View/bookShelf.php'>Aquí</a> para volver a intentarlo.";
    } else {
        // Obtener el ID de la categoría
        $catID = $book->getCatID($category);

        // Verificar si la categoría existe
        if (!$catID) {
            echo "La categoría no existe. Pulsa <a href='../View/bookShelf.php'>Aquí</a> para volver a intentarlo.";
        } else {
            // Verificar si el libro ya existe
            $book->checkExistingBook($ftitle, $fauthor, $fgenre, $catID, $userID);
        }
    }
} else {
    // Si no se ha enviado el formulario, redireccionar al usuario a la página del formulario
    header("Location: ../View/bookShelf.php");
    exit();
}
?>


</body>
</html>