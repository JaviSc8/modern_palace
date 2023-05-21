<?php
//Declaramos el uso de cookies:
  include '../controlador/cookies.php';
//Declaramos el uso de sesión del usuario:
  session_start();
//Si la cookie datos está definida, decodificamos para utilizar su información:
  if(isset($_COOKIE['datos'])){
    $b = usar('datos');
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
    <!-- Cabecera -->
    <header>
    <!-- Barra de navegación superior -->
    <nav id="nav" class="navbar navbar-expand-md navbar-light fixed-top">
      <!-- Contenedor fluido bootstrap para ocupar el ancho de la página -->
        <div class="container-fluid">
          <!-- Barra superior con información de la empresa -->
          <div class="navbar-header">
            <!-- Botón adaptable para pantallas pequeñas-->
            <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#Navbar">
              <span class="navbar-toggler-icon"></span>
            </button>
            <!-- Logo -->
            <a class="navbar-brand" href="../index.php#cuerpo"><img src="../imagenes/logo.png" id = "logotipo" alt="logotipo"></a>
          </div>
          <!-- Barra de navegación adaptable-->
        <div class="collapse navbar-collapse" id="Navbar">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item dropdown">
              <!--Elemento desplegable con destinos-->
              <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#">HOTELES</a>
                <div class="dropdown-menu">
                  <a class="dropdown-item" href="../vista/malaga.php">Málaga</a>
                  <a class="dropdown-item" href="../vista/roma.php">Roma</a>
                  <a class="dropdown-item" href="../vista/atenas.php">Atenas</a>
                  <a class="dropdown-item" href="../vista/paris.php">París</a>
                </div>
            <!--Elementos simples-->
            <li class="nav-item active"><a class="nav-link" href="eventos.php">EVENTOS</a></li>
            <li class="nav-item"><a class="nav-link" href="nosotros.php">NOSOTROS</a></li>
          </ul>
          <!--Información adicional (Teléfono, correo electrónico)-->
              <ul class="navbar-nav">
                <li class="nav-item"><a class="nav-link" href="tel:+34900004417">(+34) 900 00 44 17 </a></li>
                <li class="nav-item"><a class="nav-link" href="mailto:info@modernpalace.com"> info@modernpalace.com</a></li>
              </ul>
            </div>
            <!--Usuario, con instrucciones al hacer click según estuviera recordado en el navegador o no-->
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
                <!--Imagen con nombre de usuario o con inicio de sesión (Según haya iniciado sesión el usuario o no)-->
                <img src="../imagenes/user.png" alt="usuario" width="25" height="25">
                <?php
                //Si la cookie se encuentra definida se muestra el nombre de usuario a través de ella:
                if (isset($_COOKIE['datos'])){
                  echo $b["Usuario"];
                //Si ha iniciado sesión sin más, se muestra el nombre a través de dicha sesión:
                }elseif (isset($_SESSION["usuario"])){
                  echo $_SESSION["usuario"];
                //en caso contrario se muestra el texto "Iniciar sesión":
                }else{
                  echo "Iniciar sesión";
                }?>
              </a></li>
           </ul>
         </div>
    </nav>
    </header>
    <!--Fondo de la web-->
    <img id="fondo" src="../imagenes/fondo.jpg" alt="imagen arena blanca">
    <div id="cuerpo">
      <hr>
      <h1>Imagina el evento</h1>
      <h2>Nosotros lo haremos posible</h2>
      <hr>
      <!-- Video de presentación en bucle, con auto reproducción-->
      <div class="embed-responsive embed-responsive-21by9">
      <video class="embed-responsive-item" autoplay loop muted>
      <!--Si el video no puede mostrarse, aparece mensaje de error-->
      <source src="../imagenes/eventos/hotel.mp4" type="video/mp4"></source>
      Tu navegador no admite el elemento <code>video</code></video>
      </div>
          <hr>
          <!-- Contenedor fluido bootstrap para ocupar el ancho de la página -->
          <div class="container-fluid">
            <!--Información sobre los eventos-->
            <div id="contenidoEventos">
            <!-- Apartado 1 texto/imagen-->
            <div class="row">
              <div class="col-md-6 col-sm-6">
                <h3>Celebraciones de todo tipo</h3>
                <p>Tanto si eres un particular como una empresa, en Modern Palace nos encargamos de diseñar a medida tu evento.</p>
                <p>Congresos, reuniones, bodas, bautizos, comuniones, cumpleaños o incluso una celebración especial porque te apetece.</p>
                <p>Tu nos indicas que quieres y nosotros lo hacemos posible:</p>
                <ul>
                  <li>Eventos de hasta 200 personas</li>
                  <li>Servicios de catering propios</li>
                  <li>Diseñamos tu evento de forma personalizada</li>
                </ul>
              </div>
                <img class="col-md-6 col-sm-6" src="../imagenes/eventos/catering.jpg" alt="mesa de catering al aire libre">
            </div>
            <hr>
            <!-- Apartado 2, imagen/texto (El orden se altera en pantallas pequeñas, texto/imagen) -->
            <div class="row">
              <img class="col-md-6 order-md-1 col-12 order-2" src="../imagenes/eventos/conferencias.jpg" alt="Sala de reuniones">
              <div class="col-md-6 order-md-2 col-12 order-1">
                <h3>Entornos inolvidables</h3>
                <p>Cualquiera de nuestros hoteles dispone de varias salas de conferencias, salón para celebraciones con un aforo máximo
                  de 200 personas y posibilidad de realizar eventos al aire libre según temporada.</p>
                <p>Para solicitar presupuestos, por favor contacta con nosotros al número de reservas de nuestra sede en Málaga,
                <a href="tel:+34900004417">(+34) 900 00 44 17 </a> o al correo eléctronico <a href="mailto:eventos@modernpalace.com"> eventos@modernpalace.com</a></p>
                <ul>
                  <li>Salas de conferencias</li>
                  <li>Salones multiusos</li>
                  <li>Jardín habilitado para eventos al aire libre (según temporada)</li>
                </ul>
              </div>
            </div>
            </div>
            <hr>
            <!-- Pie de página con enlaces, información adicional, etc. -->
            <footer>
              <div id = "pie">
                <div class="row m-4 p-3 align-items-start">
                  <!--Logotipo-->
                    <a class="col-md-2 col-8 d-block w-100 m-auto order-md-1 order-2" href="#cuerpo"><img src="../imagenes/logo.png" id="logopie" alt="logotipo de modernpalace"></a>
                    <!--Información de la empresa-->
                    <div class="col-md-3 col-12 mt-2 order-md-2 order-1">
                      <h4 class="ml-4">Modern Palace Hoteles</h4>
                      <ul class="listadosPie">
                        <li>Av. Puerta del sol, 15</li>
                        <li>29602 Marbella</li>
                        <li>Málaga</li>
                        <li><a href="tel:+34900004417">(+34) 900 00 44 17 </a></li>
                        <li><a href="mailto:info@modernpalace.com"> info@modernpalace.com</a></li>
                        <li>Todos los derechos reservados</li>
                        <li>Designed by Javier Rivera Bellet</li>
                      </ul>
                    </div>
                  <!--Links a destinos-->
                  <div class="col-md-2 d-none d-md-block mt-2 order-md-3">
                    <h4 class="ml-4">Alojamientos</h4>
                    <ul class="listadosPie">
                      <li><a href="../vista/malaga.php">Málaga</a></li>
                      <li><a href="../vista/roma.php">Roma</a></li>
                      <li><a href="../vista/atenas.php">Atenas</a></li>
                      <li><a href="../vista/paris.php">París</a></li>
                    </ul>
                  </div>
                  <!--Links relacionados con la empresa-->
                  <div class="col-md-2 d-none d-md-block mt-2 order-md-4">
                    <h4 class="ml-4">Compañia</h4>
                    <ul class="listadosPie">
                      <li><a href="../vista/nosotros.php">Nosotros</a></li>
                      <li><a href="../vista/eventos.php">Eventos</a></li>
                    </ul>
                  </div>
                  <!--Links a redes sociales-->
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
    </div>
    <!-- Declaraciones opcionales relacionadas con Bootstrap -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <!-- Declaraciones javascript propias -->
    <script src="../js/jQuery.js" type="text/javascript"></script>
  </body>
</html>
