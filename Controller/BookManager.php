<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8" />
    <meta name="description" content="El rincon del lector" />
    <link rel="icon" type="favicon/x-icon" href="img/favicon.png"/>
    <link rel="stylesheet" type="text/css" href="../View/styles.css"/>
    <title>El rincón del lector</title>
  </head>
  <body>

<?php

include 'DataBaseConnection.php';

class BookManager extends DataBaseConnection{

    public  $connection;
    private $query;
    private $userID; 
    private $databooks;
    private $userList;
    

    function getBook($Title){ 
    //con esta función obtenemos la información de cada uno de los registros que hay en la base de datos en la tabla book seleccionando su ID, su titulo y el nombre del autor.
	$connection = $this->getConnection();
	$query = "SELECT BookID, Title, AuthorName FROM book WHERE Title = $Title";
	$result = mysqli_query($connection, $query);
	$this->closeConnection($connection);
    return $result;
    }


    function getAllBooks(){ 
    //con esta función obtenemos la información completa de cada registro almacenado en la tabla book.  
    $connection = $this->getConnection();
   	$query = "SELECT * FROM book";
	$result = mysqli_query($connection, $query);
	$this->closeConnection($connection);
    return $result;}
   

    function getReadBooks() {
    //con esta función obtenemos los libros que cada usuario tiene registrados como leídos. 
    // Obtenemos el ID del usuario conectado
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    $userID = $_SESSION['user'];

    // Conectamos con la base de datos
    $connection = $this->getConnection();

    // Preparamos la consulta SQL utilizando una sentencia preparada
    $query = "SELECT BookID, Title, AuthorName, Genre, CatID, MemberID FROM book 
              INNER JOIN users ON book.MemberID = users.UserID 
              WHERE CatID = 3 AND MemberID = ?";
    $stmt = mysqli_prepare($connection, $query);
    mysqli_stmt_bind_param($stmt, "i", $userID); // "i" indica que esperamos un valor entero (ID de usuario)
    
    // Ejecutamos la consulta preparada
    mysqli_stmt_execute($stmt);
    
    // Obtenemos el resultado de la consulta
    $result = mysqli_stmt_get_result($stmt);

    // Cerrarmos la conexión con la base de datos
    $this->closeConnection($connection);

    // Devolvemos el resultado
    return $result;}
   

    function getReadingBooks() {
        //con esta función obtenemos los libros que cada usuario tiene registrados como leyendo.
        //Seguimos los mismos pasos que en la aterior función.
        
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $userID = $_SESSION['user'];
        $connection = $this->getConnection();
        $query = "SELECT BookID, Title, AuthorName, Genre, CatID, MemberID FROM book 
                  INNER JOIN users ON book.MemberID = users.UserID 
                  WHERE CatID = 1 AND MemberID = ?";
        $stmt = mysqli_prepare($connection, $query);
        mysqli_stmt_bind_param($stmt, "i", $userID);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);            
        $this->closeConnection($connection);        
        return $result;
    }
    
    function getAbandonedBooks() {
        // con esta función obtenemos los libros que cada usuario tiene registrados como abandondos.
        //Seguimos los mismos pasos que en la aterior función.
       
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $userID = $_SESSION['user'];    
        $connection = $this->getConnection();    
        $query = "SELECT BookID, Title, AuthorName, Genre, CatID, MemberID FROM book 
                  INNER JOIN users ON book.MemberID = users.UserID 
                  WHERE CatID = 4 AND MemberID = ?";
        $stmt = mysqli_prepare($connection, $query);
        mysqli_stmt_bind_param($stmt, "i", $userID);        
        mysqli_stmt_execute($stmt);        
        $result = mysqli_stmt_get_result($stmt);        
        $this->closeConnection($connection);
        return $result;
    }
    

    function getToReadBooks() {
        // con esta función obtenemos los libros que cada usuario tiene registrados como pendientes de leer.
        //Seguimos los mismos pasos que en la aterior función.
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $userID = $_SESSION['user'];
        $connection = $this->getConnection();
        $query = "SELECT BookID, Title, AuthorName, Genre, CatID, MemberID FROM book 
                  INNER JOIN users ON book.MemberID = users.UserID 
                  WHERE CatID = 2 AND MemberID = ?";
        $stmt = mysqli_prepare($connection, $query);
        mysqli_stmt_bind_param($stmt, "i", $userID);       
        mysqli_stmt_execute($stmt);    
        $result = mysqli_stmt_get_result($stmt);
        $this->closeConnection($connection);
        return $result;
    }
    
 

    function addBookComplete($ftitle, $fauthor, $fgenre, $fcategory, $userID){
    //esta función se encarga de añadir nuevos registros en la base de datos en la tabla book. 
    $connection = $this->getConnection();
    $query = "INSERT INTO book (Title, AuthorName, Genre, CatID, MemberID) values('$ftitle', '$fauthor', '$fgenre', $fcategory, $userID)";
	$result = mysqli_query($connection, $query);
	return $result;
    }

    function removeBook($BookID, $userID){
    //esta función se encarga de que el usuario pueda borrar cualquier registro suyo de la tabla book
    $connection = $this->getConnection();
    $query = "DELETE FROM book WHERE BookID = $BookID AND MemberID = '$userID'";
	$result = mysqli_query($connection, $query);
	$this->closeConnection($connection);
    return $result;
    }

    function removeBookSuperAdmin($BookID){
        //esta función se encarga de que el administrador pueda borrar cualquier registro existente
        $connection = $this->getConnection();
        $query = "DELETE FROM book WHERE BookID = $BookID";
	    $result = mysqli_query($connection, $query);
	    $this->closeConnection($connection);
        return $result;
    }


    function getBookID($title, $userID){
        //esta función se encarga de recuperar de la tabla book el ID de un libro según su título y usuario al que pertenece.
        $connection = $this->getConnection();
        $query = "SELECT BookID FROM book WHERE Title = '$title' AND MemberID = $userID";
        $result = mysqli_query($connection, $query);
        if($result && mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $bookID = $row['BookID'];
           
        }else{
           $bookID = null;
        }
        
        $this->closeConnection($connection);
        return $bookID;
        
    }

    function getCatID($category){
        //esta función se encarga de que el usuario pueda introducir las categorías por nombre en vez de por ID. 
        $connection = $this->getConnection();
        $query = "SELECT CategoryID FROM category WHERE CatName = '$category'";
        $result = mysqli_query($connection, $query);
        
        if($result && mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $catID = $row['CategoryID'];
        } else {
            // La consulta no devolvió resultados, la categoría no existe
            $catID = null;
        }       
        //$this->closeConnection($connection);
        return $catID;
    }

    function getCategories(){
        // esta función se encarga de recuperar toda la información sobre categorías en la base de datos
        $connection = $this->getConnection();
        $query = "SELECT * FROM category";
        $result = mysqli_query($connection, $query);
        $this->closeConnection($connection);
        return $result;

    }   

    function editBook($BookID, $CatID, $userID){  
    //esta función se encarga de que el usuario pueda editar cualquier registro suyo de la tabla book.  
    $connection = $this->getConnection();
    $query = "UPDATE book SET CatID = $CatID WHERE BookID = $BookID AND MemberID = $userID";
	$result = mysqli_query($connection, $query);
	$this->closeConnection($connection);
    return $result;
    }

    function editBookSAdmin($BookID, $Title, $AuthorName, $Genre, $CatID, $MemberID){
    //esta función se encarga de que el administrador pueda editar cualquier registro existente. 
    $connection = $this->getConnection();
	$query = "UPDATE book SET Title = '$Title', AuthorName = '$AuthorName', Genre = '$Genre', CatID = '$CatID', MemberID = '$MemberID' WHERE BookID = '$BookID'";
	$result = mysqli_query($connection, $query);
	$this->closeConnection($connection);
    return $result;}

    function isSuperadmin($name, $password){
    //esta función se encarga de comprobar si el usuario que inicia sesión es administrador o no.
    $connection = $this->getConnection();
	$query = "SELECT users.UserID FROM users INNER JOIN setup ON users.UserID = setup.SuperAdmin WHERE users.FullName= '$name' and users.Password = '$password'";
	$result = mysqli_query($connection, $query);
	
	if($data = mysqli_fetch_array($result)){

		return true;
	} else{
		return false;
	}
    }

    function typeUser($name, $password) {
    //esta función se encarga de comprobar qué tipo de usuario es el que inicia sesión.	
    $connection = $this->getConnection();
	if ($this->isSuperadmin($name, $password)) {
		return "superadmin";
	} else {
		$query = "SELECT FullName, Password, Enabled FROM users WHERE FullName = '$name' and Password='$password'";
		$result = mysqli_query($connection, $query);
		$this->closeConnection();

		if ($data = mysqli_fetch_array($result)) {
			if ($data["Enabled"] == 1) {
				return "Restringido";
			} else if ($data["Enabled"] == 2) {
				return "autorizado";
			} else {
				return "no registrado";
			}
		}
	}
    }

    function login($user, $password) {
     //esta función se encarga de guardar la información del usuario que inicia sesión para poder mostrar sólo el contenido de el usuario conectado
     // e indicarle la página a la que se puede dirigir. 
        // Iniciar sesión
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }        
        $connection = $this->getConnection();
        $query = "SELECT UserID, FullName FROM users WHERE Password = '$password' AND FullName = '$user'";
        $result = mysqli_query($connection, $query);
    
        if (!$result) {
            echo "Error en la consulta: " . mysqli_error($connection);
            return;
        }
    
        // Obtener el resultado de la consulta como un array asociativo
        $userRow = mysqli_fetch_assoc($result);
    
        if ($userRow) {
            // Guardar el UserID y el nombre de usuario en la sesión
            $_SESSION['user'] = $userRow['UserID'];
            $_SESSION['username'] = $userRow['FullName'];
        }
    
        if (empty($user) || empty($password) || preg_match('/^\d/', $user)) {
            echo "<p class='mensaje'>Escribe bien los campos. Pulsa <a href='../index.php'>Aquí</a> para volver a intentarlo.</p>";
        } else {
            // Obtener el tipo de usuario
            $userType = $this->typeUser($user, $password);
        
            // Con este switch comprobamos qué tipo de usuario entra y le mostramos el mensaje correspondiente según sus permisos.
            switch ($userType) {
                case "superadmin":
                    echo "<p class='mensaje'>Bienvenido $user. Pulsa <a href='data.php'>Aquí</a> para entrar al panel de registros.</p>";
                    break;
                case "autorizado":
                    echo "<p class='mensaje'>Bienvenido $user. Pulsa <a href='../View/bookShelf.php'>Aquí</a> para entrar en el gestor de libros.</p>";
                    break;
                case "Restringido":
                    echo "<p class='mensaje'>Bienvenido $user. No tienes permisos para entrar. Pulsa <a href='../index.php'>Aquí</a> para volver atrás.</p>";
                    break;
                default:
                    echo "<p class='mensaje'>Usted no está registrado en el sistema. Pulsa <a href='../View/UserRegister.php'>Aquí</a> para registrarse.</p>";
            }
        }
        
    }
    

    function setUserID($userID) {
        //esta función extrae y establece el usuario activo tras que este se conecte.
        $this->userID = $userID;
    }       
    
    
    function logout($logOut){
        //esta función se encarga de cerrar la sesión del usuario activo.
        session_start();
        session_unset();
        session_destroy();
        
    }       

    function getUserList(){
	//Aquí se realiza la consulta de todos los usuarios de la base de datos
    $connection = $this->getConnection();
    $query = "SELECT UserID, FullName, Password, Email, Enabled FROM users";
    $result = mysqli_query($connection, $query);
    $this->closeConnection();
    return $result;
    }

    function checkExistingUser($email, $password, $user){
        //esta función comprueba si el usuario que quiere registrarse ya existe para no repetir el registro.
        $connection = $this->getConnection();
        $query = "SELECT COUNT(*) AS count FROM users WHERE Email = '$email'";
        $result = mysqli_query($connection, $query);
        $row = mysqli_fetch_assoc($result);
        $emailExists = $row['count'] > 0;    
        // Verificar si el nombre completo ya está registrado
        $query = "SELECT COUNT(*) AS count FROM users WHERE FullName = '$user'";
        $result = mysqli_query($connection, $query);
        $row = mysqli_fetch_assoc($result);
        $fullNameExists = $row['count'] > 0;
    
        // Si el correo electrónico o el nombre completo ya existen, devolvemos false
        if ($emailExists || $fullNameExists) {

            echo"Nombre de usuario o correo elctrónico en uso. Pulsa <a href='../View/UserRegister.php'>Aquí</a> para volverlo a intentar";
            $this->closeConnection();
            return false;
        }else{
            
            $this->addUser($email, $password, $user);

        } 

        echo "Usuario registrado correctamente. Pulsa <a href='../index.php'>Aquí</a> para iniciar sesión.";

    }

    function checkExistingBook($title, $author, $genre, $category, $userID){
        //esta función se encarga de comprobar si el libro que el usuario quiere almacenar ya lo tiene en la estantería. 
        $connection = $this->getConnection();
    
        $query = "SELECT COUNT(*) AS count FROM book WHERE Title = '$title' AND MemberID = '$userID'";
        $result = mysqli_query($connection, $query);
        $row = mysqli_fetch_assoc($result);
        $bookExists = $row['count'] > 0;
    
        if ($bookExists) {
            echo "Este libro ya está en tu registro. Pulsa <a href='../View/BookShelf.php'>Aquí</a> para volver";
            $this->closeConnection($connection);
            return false;
        } else {
            $this->addBookComplete($title, $author, $genre, $category, $userID);
            echo "Libro añadido correctamente. Pulsa <a href='../View/BookShelf.php'>Aquí</a> para volver.";
            $this->closeConnection($connection);
        }       
    }
    

    function addUser($Email, $Password, $FullName) {
        //esta función se encarga de añadir nuevos usuarios en la base de datos.                
        $connection = $this->getConnection();
        $query = "INSERT INTO users (Email, Password, FullName, Enabled) VALUES ('$Email', '$Password', '$FullName', 2)";
        $result = mysqli_query($connection, $query);        
        $this->closeConnection();
        return $result;
    }
    

    function removeUser($UserID){
    //esta función se encarga de borrar cualquier usuario que exista en la base de datos. 
	$connection = $this->getConnection();
	$query = "DELETE FROM users WHERE UserID = $UserID";
	$result = mysqli_query($connection, $query);
	$this->closeConnection();
    return $result;
    }

    function changeUser($UserID, $permission){
     // esta función se encarga de cambiar los permisos de los usuarios. 
     $connection = $this->getConnection();
	 $query = "UPDATE users SET Enabled = $permission WHERE UserID = $UserID";
	 $result = mysqli_query($connection, $query);
	 $this->closeConnection();
     return $result;
    }

    function drawDataTable(){
        
        //esta función se encarga de pintar o dibujar en la aplicación web todos los datos de todos los registros que existen en la tabla book. 
        
        $databooks= $this->getAllBooks();
              
              echo"<table class='table'>\n
                      <tr>\n
                      <th>\n
                      <th>\n
                      <th>Lista de registros</th>\n
                      <th>\n
                      <th>\n
                      </tr>\n  
                      <tr>\n
                          <th>ID</th>\n
                          <th>Título</th>\n
                          <th>Nombre del Autor</th>\n
                          <th>Género Literario</th>\n
                          <th>Categoría</th>\n
                          <th>Usuario</th>\n
                          <th class='thHidden'></th>\n
                     </tr>\n";
  
          while ($fila = mysqli_fetch_assoc($databooks)){
              echo "<tr>\n" .
               "<td>". $fila['BookID'] ."</td>\n" .
               "<td>". $fila['Title'] ."</td>\n" .
               "<td>". $fila['AuthorName'] ."</td>\n" .
               "<td>". $fila['Genre'] ."</td>\n" .
               "<td>". $fila['CatID'] ."</td>\n" .
               "<td>". $fila['MemberID'] ."</td>" .
              "<td class='thHidden'>". "<form action='DeleteSA.php' method='post'>" .
              "<input type='hidden' name='BookID' value='". $fila['BookID'] ."'>" .
              "<button type='submit' id='deleteForm' name='borrar'>Borrar</button>" .
              "</form>" ."</td>\n".
              "</tr>\n";
  
          }
  
      }

      function drawAllCategories(){

        //esta función se encarga de pintar o dibujar en la aplicación web la información completa que hay en la tabla categories.

        $databooks = $this->getCategories();
        echo"<table class='table'>\n
            <tr>\n
            <th></th>\n
            <th>Categorías</th>\n
            <th></th>\n
            </tr>\n  
             <tr>\n
             <th>ID</th>\n
             <th>Nombre de la categoría</th>\n
             <th></th>\n
             </tr>\n";

            while ($fila = mysqli_fetch_assoc($databooks)){
            echo "<tr>\n" .
            "<td>". $fila['CategoryID'] ."</td>\n" .
            "<td>". $fila['CatName'] ."</td>\n" .
            " </tr>\n";
            }

        }
  
      function drawReadTable(){

        //esta función se encarga de pintar o dibujar en la aplicación web la información de los libros leídos de cada usuario.
                    
        $databooks= $this->getReadBooks();
    
        echo "<table class='table'>\n
                        <tr>\n
                            <th>ID</th>\n
                            <th>Título</th>\n
                            <th>Nombre Autor</th>\n
                            <th>Género</th>\n
                            <th class='thHidden'></th>\n
                            <th class='thHidden'></th>\n
                        </tr>\n";
    
        while ($fila = mysqli_fetch_assoc($databooks)){
            echo "<tr>\n" .
                "<td>". $fila['BookID'] ."</td>\n" .
                "<td>". $fila['Title'] ."</td>\n" .
                "<td>". $fila['AuthorName'] ."</td>\n" .
                "<td>". $fila['Genre'] ."</td>\n" .
                "<td class='thHidden'>". "<form action='../Controller/DeleteRegister.php' method='post'>" .
                "<input type='hidden' name='BookID' value='". $fila['BookID'] ."'>" .
                "<button type='submit' id='deleteForm' name='borrar'>Borrar</button>" .
                "</form>" ."</td>\n".
                "<td class='thHidden'>". "<button id='modifyButtonForm'><a href='../View/ModifyRegister.php'>Modificar Registro</a>" .                 
                "</button>" ."</td>\n".
                "</tr>\n";
    
        }
        echo "</table>";
    }
        
   function drawReadingTable(){

    //esta función se encarga de pintar o dibujar en la aplicación web la información de los libro que está leyendo cada usuario.
        
        $databooks= $this->getReadingBooks();
    
        echo "<table class='table'>\n
                        <tr>\n
                            <th>ID</th>\n
                            <th>Título</th>\n
                            <th>Nombre Autor</th>\n
                            <th>Género</th>\n
                            <th class='thHidden'></th>\n
                            <th class='thHidden'></th>\n
                        </tr>\n";
    
        while ($fila = mysqli_fetch_assoc($databooks)){
            echo "<tr>\n" .
                "<td>". $fila['BookID'] ."</td>\n" .
                "<td>". $fila['Title'] ."</td>\n" .
                "<td>". $fila['AuthorName'] ."</td>\n" .
                "<td>". $fila['Genre'] ."</td>\n" .
                "<td class='thHidden'>". "<form action='../Controller/DeleteRegister.php' method='post'>" .
                "<input type='hidden' name='BookID' value='". $fila['BookID'] ."'>" .
                "<button type='submit' id='deleteForm' name='borrar'>Borrar</button>" .
                "</form>" ."</td>\n".
                "<td class='thHidden'>". "<button id='modifyButtonForm'><a href='../View/ModifyRegister.php'>Modificar Registro</a>" .                 
                "</button>" ."</td>\n".
                "</tr>\n";
    
        }
        echo "</table>";
    }

    function drawAbandonedTable(){

        //esta función se encarga de pintar o dibujar en la aplicación web la información de los libros abandados de cada usuario.
        
        $databooks= $this->getAbandonedBooks();
    
        echo "<table class='table'>\n
                        <tr>\n
                            <th>ID</th>\n
                            <th>Título</th>\n
                            <th>Nombre Autor</th>\n
                            <th>Género</th>\n
                            <th class='thHidden'></th>\n
                            <th class='thHidden'></th>\n
                        </tr>\n";
    
        while ($fila = mysqli_fetch_assoc($databooks)){
            echo "<tr>\n" .
                "<td>". $fila['BookID'] ."</td>\n" .
                "<td>". $fila['Title'] ."</td>\n" .
                "<td>". $fila['AuthorName'] ."</td>\n" .
                "<td>". $fila['Genre'] ."</td>\n" .
                "<td class='thHidden'>". "<form action='../Controller/DeleteRegister.php' method='post'>" .
                "<input type='hidden' name='BookID' value='". $fila['BookID'] ."'>" .
                "<button type='submit' id='deleteForm' name='borrar'>Borrar</button>" .
                "</form>" ."</td>\n".
                "<td class='thHidden'>". "<button id='modifyButtonForm'><a href='../View/ModifyRegister.php'>Modificar Registro</a>" .                 
                "</button>" ."</td>\n".
                "</tr>\n";
    
        }
        echo "</table>";
    }
    
    function drawToReadTable(){

        //esta función se encarga de pintar o dibujar en la aplicación web la información de los libros pendientes de cada usuario.
        
        $databooks= $this->getToReadBooks();
    
        echo "<table class='table'>\n
                        <tr>\n
                            <th>ID</th>\n
                            <th>Título</th>\n
                            <th>Nombre Autor</th>\n
                            <th>Género</th>\n
                            <th class='thHidden'></th>\n
                            <th class='thHidden'></th>\n
                        </tr>\n";
    
        while ($fila = mysqli_fetch_assoc($databooks)){
            echo "<tr>\n" .
                "<td>". $fila['BookID'] ."</td>\n" .
                "<td>". $fila['Title'] ."</td>\n" .
                "<td>". $fila['AuthorName'] ."</td>\n" .
                "<td>". $fila['Genre'] ."</td>\n" .
                "<td class='thHidden'>". "<form action='../Controller/DeleteRegister.php' method='post'>" .
                "<input type='hidden' name='BookID' value='". $fila['BookID'] ."'>" .
                "<button type='submit' id='deleteForm' name='borrar'>Borrar</button>" .
                "</form>" ."</td>\n".
                "<td class='thHidden'>". "<button id='modifyButtonForm'><a href='../View/ModifyRegister.php'>Modificar Registro</a>" .                 
                "</button>" ."</td>\n".
                "</tr>\n";
    
        }
        echo "</table>";
    }

    function drawUsers(){

        //esta función se encarga de pintar o dibujar en la aplicación web la información todos los usuarios existentes en la tabla users. 

      $userList= $this->getUserList();
    
        echo "<table class='table'>\n
                        <tr>\n
                        <th></th>\n
                        <th></th>\n
                        <th id='getUsersListTH'>Lista de usuarios</th>\n
                        </tr>\n  
                        <tr>\n
                            <th>UserID</th>\n
                            <th>Nombre Completo</th>\n
                            <th>E-mail</th>\n
                            <th>Contraseña</th>\n
                            <th class='thHidden'>Permisos</th>\n
                            <th class='thHidden'></th>\n
                        </tr>\n";
    
        while ($fila = mysqli_fetch_assoc($userList)){
            echo "<tr>\n" .
                "<td>". $fila['UserID'] ."</td>\n" .
                "<td>". $fila['FullName'] ."</td>\n" .
                "<td>". $fila['Email'] ."</td>\n" .
                "<td>". $fila['Password'] ."</td>\n" .
                "<td>". $fila['Enabled'] ."</td>\n" .
                "<td class='thHidden'>". "<form action='DeleteUser.php' method='POST'>" .
                "<input type='hidden' name='UserID' value='". $fila['UserID'] ."'>" .
                "<button class='thHidden' type='submit' id='deleteForm' name='borrar'>Borrar</button>" .
                "</form>" ."</td>\n".
                "</tr>\n";      
        }
        echo "</table>";
     
    }


}

?>

</body>
</html>

