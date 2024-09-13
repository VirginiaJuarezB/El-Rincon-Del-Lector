<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="El rincon del lector" />
    <link rel="icon" type="favicon/x-icon" href="../img/favicon.png" />
    <link rel="stylesheet" type="text/css" href="styles.css"/>    
    <title>El rincón del lector</title>
  </head>
  <body>
   
  <div class="cabecera" id="cabeceraUser">
    <header>
    <h3>El rincón del lector</h3>
    </header>
  </div>
          
    <div class="navbar" id="navbarUser">
      <nav id="menu">
            <ul>
              <li><a href="../index.php">INICIO</a></li>
            </ul>
      </nav>
    </div>
    
    <br>

    <section id="sesion">
      <div class="flex-container">
      <h1>Bienvenido/a</h1>
      <form action="../Controller/RegisterUser.php" method="POST">
        <fieldset>
          <legend>Regístrate</legend>
            <label for="user">Elige tu nombre de usuario:</label>
            <input type="text" name="user" id="userReg" placeholder="Nombre de usuario..."/>
          
            <label for="password">Elige tu contraseña.</label>
            <input type="password" name="password" id="passwordReg" placeholder="Contraseña..."/>

            <label for="email">Introduce tu correo electrónico</label>
            <input type="email" name="email" id="emailReg" placeholder="E-mail..."/>
          
          <div id="containerReg1">
          <input type="submit" name="enviar" id="enviarReg" value="Enviar" />
          <input type="reset" id="resetReg" value="Limpiar" />
          <button id="volverReg"><a href='../index.php'>Volver</a></button>       
          </div>           
        </fieldset>
      </form>
      </div>
      



    </section>



    <footer>
       <p>&copy; Virginia Juárez Bermejo</p>
    </footer>

 
  </body>
</html>
