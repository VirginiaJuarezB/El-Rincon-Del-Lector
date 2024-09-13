<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="El rincon del lector" />
    <link rel="icon" type="favicon/x-icon" href="img/favicon.png" />
    <link rel="stylesheet" type="text/css" href="View/styles.css"/>
    <title>El rincón del lector</title>
  </head>
  <body>

  
    
  <div class="cabecera" id="cabeceraIndex">
    <header>
    <h3>El rincón del lector</h3>
    </header>
  </div>
          
    <div class="navbar" id="navbarIndex">
      <nav id="menu">
            <ul>
              <li><a href="index.php">INICIO</a></li>
            </ul>
      </nav>
    </div>
    
    <br>

    <section id="sesion">
      <h1 id="welcome">Bienvenido/a</h1>
      <div class="flex-container" id="flexContainer">
        <div id="container1" style="order: 1">
        <form id="loginForm" action="Controller/userForm.php" method="POST">
          <fieldset>
          <legend>Inicia sesión para gestionar tus libros</legend>

          <div id="labelsIndex"><label for="user" id="labelUser">Nombre de usuario:</label>
          <input type="text" name="user" id="userLogIn" placeholder="Nombre de usuario..."/>
          <label for="password" id="labelPassword">Contraseña:</label>
          <input type="password" name="password" id="passwordLogIn" placeholder="Contraseña..."/></div>
          

          <div id="buttonsIndex">
          <input type="submit" name="enviar" id="enviarIndex" value="Enviar" />
          <input type="reset" id="resetIndex" value="Limpiar" /> 
          </div>
          
          </fieldset>
       </form> 
       </div>
       <div id="container2" style="order: 2">
        <h3>¿Aún no estás registrado?</h3>
        <p>Pulsa aquí para registrarte:</p>
        <a id="registerLink" href="View/UserRegister.php">REGÍSTRATE</a>
        </div>        
      </div>
    </section>



    <footer>
       <p>&copy; Virginia Juárez Bermejo</p>
    </footer>

 
  </body>
</html>
