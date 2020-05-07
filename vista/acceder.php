<?php
//Declaramos el uso de cookies y las funciones de seguridad:
include '../modelo/cookies.php';
include '../controlador/error.php';
//Si la cookie está definida, utilizamos su información:
if (isset($_COOKIE["datos"])){
  $a = usar("datos");
}
if(isset($_COOKIE['reserva'])) {
  $b = usar("reserva");
}
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
            <li class="nav-item"><a class="nav-link" href="nosotros.php">NOSOTROS</a></li>
            <li class="nav-item"><a class="nav-link" href="#enlaces">ESPACIO 4</a></li>
          </ul>
              <ul class="navbar-nav">
                <li class="nav-item"><a class="nav-link" href="tel:+34952004417">(+34) 952 00 44 17 </a></li>
                <li class="nav-item"><a class="nav-link" href="mailto:info@modernpalace.com"> info@modernpalace.com</a></li>
              </ul>
            </div>
            <ul class="navbar-nav navbar-expand">
              <li class="nav-item"><a class="nav-link active" href=
                <?php
                //Si existe la cookie con los datos del usuario se reenvia al controlador para que recupere la sesión y redirija a sesion.php:
                if(isset($_COOKIE["datos"])){
                  echo "../controlador/control.php?rec=true";
                //Si el usuario ya se ha logado redirige a su sesión hasta que se cierre el navegador:
                }elseif (isset($_SESSION["usuario"])){
                  echo "../vista/sesion.php?user=ok";
                //En caso contrario se vuelve al login (Acceder.php):
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
    <img id="fondo" src="../imagenes/fondo.jpg" alt="imagen arena blanca">
    <!-- contenedor fluido bootstrap para toda la página -->
    <div id="cuerpo" class="container-fluid">
      <hr>
     <div class="destacar">
       <div class="row justify-content-start alig-items-center">
         <div class="col-md-2 col-sm-6">
           <form action="../controlador/control.php" method="post">
             <div class="form-group">
               <label for="usuario">Usuario</label><br>
               <input type="text" class="form-control" name="usuario" required>
            </div>
            <div class="form-group">
               <label for="password">Contraseña</label><br>
               <input type="password" class="form-control" name="password" required>
            </div>
            <div class="form-check">
              <input type="checkbox" class="form-check-input" name="recuerda" value="1">
              <label for="recuerda" class="form-check-label">Recuerdame</label>
            </div>
            <br>
            <div class="">
             <input type="submit" id="acceder" class="btn btn-primary" value="Acceder">
            </div>
           </form>
           <br>
           <div class="">
             <button class="btn btn-success"><a href="registro.php" class="text-light">Registro de usuario</a></button>
          </div>
        </div>
           <?php
           falloAcceder();
          ?>
      </div>
    </div>
     <hr>
     <!-- Pie de página con enlaces, información adicional, etc. -->
     <footer>
       <div id = "pie">
         <div class="row m-4 p-3 align-items-start">
             <a class="col-md-2 col-8 d-block w-100 m-auto order-md-1 order-2" href="#cuerpo"><img src="../imagenes/logo.png" id="logopie" alt="logotipo de modernpalace"></a>
             <div class="col-md-3 col-12 mt-2 order-md-2 order-1">
               <h4 class="ml-4">Modern Palace Hoteles</h4>
               <ul class="listadosPie">
                 <li>Av. Puerta del sol, 15</li>
                 <li>29602 Marbella</li>
                 <li>Málaga</li>
                 <li><a href="tel:+34990004417">(+34) 952 00 44 17 </a></li>
                 <li><a href="mailto:info@modernpalace.com"> info@modernpalace.com</a></li>
                 <li>Todos los derechos reservados</li>
               </ul>
             </div>
           <div class="col-md-2 d-none d-md-block mt-2 order-md-3">
             <h4 class="ml-4">Alojamientos</h4>
             <ul class="listadosPie">
               <li><a href="../vista/malaga.php">Málaga</a></li>
               <li><a href="../vista/roma.php">Roma</a></li>
               <li><a href="../vista/atenas.php">Atenas</a></li>
               <li><a href="../vista/paris.php">París</a></li>
             </ul>
           </div>
           <div class="col-md-2 d-none d-md-block mt-2 order-md-4">
             <h4 class="ml-4">Compañia</h4>
             <ul class="listadosPie">
               <li><a href="../vista/nosotros.php">Nosotros</a></li>
               <li><a href="../vista/eventos.php">Eventos</a></li>
             </ul>
           </div>
           <div class="col-md-3 d-none d-md-block mt-2 order-md-5">
             <h4 class="ml-4">Síguenos</h4>
             <ul class="listadosPie">
               <li class="zoom"><a href="https://es-es.facebook.com/"><img class="enlacesBlack" src="../imagenes/facebookBlack.png" alt="link facebook"></a></li>
               <li class="zoom"><a href="https://www.instagram.com/"><img class="enlacesBlack" src="../imagenes/instagramBlack.png" alt="link instagram"></a></li>
               <li class="zoom"><a href="https://twitter.com/"><img class="enlacesBlack" src="../imagenes/twitterBlack.png" alt="link twitter"></a></li>
               <li class="zoom"><a href="https://es.linkedin.com/"><img class="enlacesBlack" src="../imagenes/linkedinBlack.png" alt="link linkedin"></a></li>
             </ul>
           </div>
         </div>
       </div>
     </footer>
   </div>
   <!-- Declaraciones opcionales relacionadas con Bootstrap -->
   <!-- jQuery first, then Popper.js, then Bootstrap JS -->
   <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
   <!--<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>-->
   <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
   <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
   <!-- Declaraciones javascript propias -->
   <script src="../js/jQuery.js" type="text/javascript"></script>
  </body>
</html>
