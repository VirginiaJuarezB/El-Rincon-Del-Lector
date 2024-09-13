<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8" />
    <meta name="description" content="El rincon del lector" />
    <link rel="icon" type="favicon/x-icon" href="../img/favicon.png"/>
    <link rel="stylesheet" type="text/css" href="styles.css"/>
    <title>El rincón del lector</title>
  </head>
  <body>
   
  <div class="cabecera" id="cabeceraModify">
    <header>
    <h3>El rincón del lector</h3>
    </header>
  </div>
          
  <div id="navbarShelf">
      <nav id="menuShelf" >
            <ul>
              <li id="index"><a href="../index.php">INICIO</a></li>
              <li id="shelf"><a href="bookShelf.php">MI ESTANTERÍA</a></li>
            </ul>
      </nav>
    </div>
    
    <br>

      <main>
      
      <div class="flex-container" id="modifyForm">
        <h2>Modifica tu registro:</h2>
       <form action="../Controller/RecieveModifyRegister.php" method="POST">
        <label for="title" id="titleLabel">Título del libro:</label><br>
        <input type="text" id="title" name="title"><br>
        <label for="category" id="categoryLabel">Categoría:</label><br>
        <input type="text" id="category" name="category"><br><br>
        <input type="submit" id="enviarMod" value="Guardar">
        <button id="modifyButton"><a href="bookShelf.php">Volver a estantería</a></button>
       </form> 
      
      </div>
      
      

      </main>

      <footer>
        <p>Virginia Juárez Bermejo &copy;</p>
      </footer>
  
  </body>

  </html>
