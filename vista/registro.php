<?php
//Declaramos el uso de las funciones de seguridad:
include '../controlador/error.php';
//Iniciamos sesión:
  session_start();
 ?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <!-- Meta tags para diseño responsive -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Declaración Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
    integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <!--Declaración Google Fonts-->
    <link href="https://fonts.googleapis.com/css?family=Great+Vibes|Roboto&display=swap" rel="stylesheet">
    <!-- Declaración CSS propio -->
    <link rel="stylesheet" type="text/css" href="../estilos.css" media="screen"/>
    <!-- Declaración favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="../imagenes/favicon.ico"/>
    <title>Modern Palace Hoteles | Elige tu destino</title>
  </head>
  <body>
    <!-- cabecera -->
    <header>
    <!-- barra de navegación superior -->
    <nav id="nav" class="navbar navbar-expand-md navbar-light fixed-top">
      <!-- Barra de navegación -->
        <div class="container-fluid">
          <!-- barra superior con información de la empresa -->
          <div class="navbar-header">
            <!-- botón adaptable para pantallas pequeñas-->
            <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#Navbar">
              <span class="navbar-toggler-icon"></span>
            </button>
            <!-- logo -->
            <a class="navbar-brand" href="../index.php"><img src="../imagenes/logo.png" id = "logotipo" alt="logotipo"></a>
          </div>
          <!-- barra de navegación adaptable-->
        <div class="collapse navbar-collapse" id="Navbar">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item dropdown active">
              <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#">HOTELES</a>
                <div class="dropdown-menu">
                  <a class="dropdown-item" href="malaga.php">Málaga</a>
                  <a class="dropdown-item" href="#">Roma</a>
                  <a class="dropdown-item" href="#">Atenas</a>
                  <a class="dropdown-item" href="#">París</a>
                </div>
            <li class="nav-item"><a class="nav-link" href="eventos.php">EVENTOS</a></li>
            <li class="nav-item"><a class="nav-link" href="#enlaces">NOSOTROS</a></li>
            <li class="nav-item"><a class="nav-link" href="#enlaces">ESPACIO 4</a></li>
          </ul>
              <ul class="navbar-nav">
                <li class="nav-item"><a class="nav-link" href="tel:+34990004417">(+34) 990 00 44 17 </a></li>
                <li class="nav-item"><a class="nav-link" href="mailto:info@modernpalace.com"> info@modernpalace.com</a></li>
              </ul>
            </div>
            <ul class="navbar-nav navbar-expand">
              <li class="nav-item"><a class="nav-link active" href=
                <?php
                if(isset($_COOKIE["datos"])){
                  echo "controlador/control.php?rec=true";
                }else {
                  echo "../vista/acceder.php";
                }
                 ?>>
                <img src="../imagenes/user.png" alt="usuario" width="25" height="25">
                <?php
                if (isset($_SESSION["usuario"])) {
                  echo $_SESSION["usuario"];
                }else {
                  echo "Iniciar sesión";
                }?>
              </a></li>
           </ul>
         </div>
    </nav>
    </header>
    <img id="fondo" src="../imagenes/fondo3.jpg" alt="fondo paisaje">
    <!-- contenedor fluido bootstrap para toda la página -->
    <div id="cuerpo" class="container-fluid">
      <hr>
     <div class="destacar">
       <div class="row justify-content-center alig-items-center">
         <div class="col-4">
           <form action="../controlador/control.php" method="post">
             <div class="form-group">
               <div class="">
                 <label for="nuevoUsuario">Usuario</label><br>
                 <input type="text" class="form-control input-sm" name="nuevoUsuario">
               </div>
               <div class="">
                 <label for="password">Contraseña</label><br>
                 <input type="password" class="form-control" name="password">
               </div>
               <div class="">
                 <label for="password2">Repetir Contraseña</label><br>
                 <input type="password" class="form-control" name="password2">
               </div>
             </div>
          </div>
          <div class="col-4">
             <div class="">
               <label for="nombre">Nombre</label><br>
               <input type="text" class="form-control" name="nombre">
             </div>
             <div class="">
               <label for="apellidos">Apellidos</label><br>
               <input type="text" class="form-control" name="apellidos">
             </div>
             <div class="">
               <label for="email">Correo electrónico</label><br>
               <input type="text" class="form-control" name="email">
             </div>
          </div>
        </div>
       <?php
       falloRegistro();
      ?>
      <div class="row justify-content-center alig-items-center">
          <div class="">
            <input type="submit" class="boton btn btn-primary" value="Enviar">
          </div>
      </div>
     </form>
     </div>
     <hr>
     <!-- Pie de página con políticas de privacidad, etc. -->
     <footer>
       <div id = "pie" class="jumbotron">
         <div class="row">
           <img class="col-2 enlaces" src="../imagenes/logo.png" alt="logotipo de modernpalace" id="logopie">
           <a class="col enlaceTexto" href="#">Aviso legal, privacidad y cookies</a>
           <a class="col enlaceTexto" href="#">ModernPalace.com</a>
         </div>
       </div>
     </footer>
   </div>
   <!-- Declaraciones opcionales relacionadas con Bootstrap -->
   <!-- jQuery first, then Popper.js, then Bootstrap JS -->
   <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
   <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
   <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
   <!-- Declaraciones javascript propias -->
   <script src="../js/jQuery.js" type="text/javascript"></script>
  </body>
</html>
