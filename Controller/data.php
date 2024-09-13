<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="El rincon del lector" />
    <link rel="icon" type="favicon/x-icon" href="../img/favicon.png" />
    <link rel="stylesheet" type="text/css" href="../View/styles.css"/>
    <title>El rincón del lector</title>
  </head>
  <body>

  <?php
   include 'BookManager.php';
  ?>

    <div class="cabecera" id="cabeceraData">
      <header>
      <h3>El rincón del lector</h3>
      </header>
    </div>

  <div class="navbar" id="navbarData">
      <nav id="menu">
            <ul>
              <li><a href="../index.php">INICIO</a></li>
            </ul>
      </nav>
  </div>

  <h3>Bienvenido/a</h3>

  <form action="LogOut.php" method="POST"><input type="submit" id="logout" name="logout" value="Cerrar sesión"></form> <br> 

  <div class="flex-container" id="adminData">

  <div style="order:1" flex-basis="500px" id="CategoriesContainer">
        <?php
        $table = new BookManager;
        $table->drawAllCategories();
        ?>       
 </div>

 <br>

  <div style="order:2" flex-basis="500px" id="DataContainer">
        <?php
         $table=new BookManager;
         $table->drawDataTable();
         ?>
      <br>        
    <form id="SAForm" action="SuperAdminModify.php" method="POST">            
    <fieldset class="adminField">
    <legend class="adminLegend">Modificar registros:</legend><br>
    <label class="label" for="BookID">ID del libro:</label> <br>
    <input class="inputNum" type="number" id="BookID" name="BookID"><br>
    <label class="label" for="title">Titulo del libro:</label><br>
    <input class="input" type="text" id="title" name="title"><br>
    <label class="label" for="author">Nombre del autor:</label><br>
    <input class="input" type="text" id="author" name="author"><br>
    <label class="label" for="genre">Género literario:</label><br>
    <input class="input" type="text" id="genre" name="genre"><br>
    <label class="label" for="category">Categoría:</label><br>
    <input class="inputNum" type="number" id="category" name="category" min="1" max="4"><br>
    <label class="label" for="user">Usuario:</label><br>
    <input class="inputNum" type="number" id="user" name="user"><br>
    <input class="adminButton" type="submit" id ="enviarData" value="Guardar"><br>
    </fieldset>                 
    </form>
  </div>
<br>
<div style="order:3" flex-basis="500px" id="userContainer">

     <?php
      $table = new BookManager;
      $table-> drawUsers();
      ?> 
      <br>
      
        <form id="adminUsersForm" action="UserChangePermission.php" method="POST">
        <fieldset class="adminField">
        <legend class="adminLegend">Modificar permisos de Usuarios</legend>
        <label class="label" for="UserID">Introduce el ID del Usuario para cambiar los permisos:</label><br>
        <input class="inputNum" type="number" id="UserID" name="UserID" min="1"><br>
        <label class="label" for="permission">Elige el tipo de permiso:</label><br>
        <input class="inputNum" type="number" id="permission" name="permission" min="1" max="2"><br>
        <input type="submit" value="Guardar">
        </fieldset>
        </form>
</div>

</div>

<footer><p>&copy; Virginia Juárez Bermejo</p></footer>  

</body>
</html>





    
     
    
      
      

