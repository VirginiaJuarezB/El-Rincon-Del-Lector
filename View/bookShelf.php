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

  <?php
  include '../Controller/BookManager.php';
  ?>

  <div class="cabecera" id="cabeceraShelf">
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
        <div id="shelfTitle"><h1> Hola, aquí están tus libros</h1></div>
       
        <div class="flex-container" id="estanteria">
           
                <div id="readContainer" style="order:1">
                    <h2>Leídos</h2>

                    <br>

                    <?php
                      $table = new BookManager;
                      $table->drawReadTable();
                    ?>
                                                        
               </div>

               <div id="readingContainer" style="order:2">
                    <h2>Leyendo</h2>

                    <br>

                    <?php
                      $table = new BookManager;
                      $table->drawReadingTable();
                    ?>
                 
               </div>
            
            
                <div id="toReadContainer" style="order:3">
                    <h2>Pendiente</h2>

                    <br>
                    <?php   

                      $table = new BookManager;
                      $table->drawToReadTable();

                    ?>

               </div>
            
            
                <div id="abandonedContainer" style="order:4">
                    <h2>Abandonados</h2>
                    <br>
                    <?php
                     $table = new BookManager;
                     $table->drawAbandonedTable();
                    ?>
                                      
               </div>

               <br>
               <div id="formContainer" style="order:4">
               <h2>Añade un título a tu registro:</h2>
               <form action="../Controller/AddBookForm.php" method="POST">
                    <label for="ftitle">Titulo del libro:</label><br>
                    <input type="text" id="ftitle" name="ftitle"><br>
                    <label for="fauthor">Nombre del autor:</label><br>
                    <input type="text" id="fauthor" name="fauthor"><br><br>
                    <label for="fgenre">Género literario:</label><br>
                    <input type="text" id="fgenre" name="fgenre"><br><br>
                    <label for="fcategory">Categoría:</label><br>
                    <input type="text" id="fcategory" name="fcategory"><br><br>
                    <input type="submit" id="enviarShelf" name="enviar" value="Guardar">
                  </form>
               </div>

               <div id="logOutShelf" style="order: 5">

                <h3>Haz click aquí para desconectar:</h3>          
                <form action="../Controller/LogOut.php" method="POST"><input type="submit" id="logout" name="logout" value="Cerrar sesión">
      
              </div>
                
      </div>
            
              

        
      </main>

      <footer>
        <p>Virginia Juárez Bermejo &copy;</p>
      </footer>
   
      <script> 
        var sound = new Audio();

       sound.src="audio.wav";

       document.getElementById("enviarShelf").addEventListener("click", function() {
        sound.play();
        });
      </script>

      
  </body>
  

  </html>