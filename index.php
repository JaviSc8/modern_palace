<?php
//Declaramos el uso de cookies:
  include 'modelo/cookies.php';
  //Declaramos el uso de las funciones de error:
  include 'controlador/error.php';
  //Declaramos el inicio de sesión del usuario:
    session_start();
  //Si la cookie está definida, utilizamos su información:
  if(isset($_COOKIE['reserva'])) {
    $a = usar("reserva");
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
    <!-- Declaración Leaflet -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.6.0/dist/leaflet.css"
   integrity="sha512-xwE/Az9zrjBIphAcBb3F6JVqxf46+CDLwfLMHloNu6KEQCAWi6HcDUbeOfBIptF7tcCzusKFjFw2yuvEpDL9wQ=="
   crossorigin=""/>
    <!-- Declaración CSS propio -->
    <link rel="stylesheet" type="text/css" href="estilos.css" media="screen"/>
    <!-- Declaración favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="imagenes/favicon.ico"/>
    <title>Modern Palace Hoteles | Elige tu destino</title>
  </head>
  <body>
    <!-- cabecera -->
    <header>
    <!-- barra de navegación superior -->
    <nav id="nav" class="navbar navbar-expand-md navbar-light fixed-top">
      <!-- Contenedor fluido para ocupar el ancho de la página -->
        <div class="container-fluid">
          <!-- barra superior con información de la empresa -->
          <div class="navbar-header">
            <!-- botón adaptable para pantallas pequeñas-->
            <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#Navbar">
              <span class="navbar-toggler-icon"></span>
            </button>
            <!-- logo -->
            <a class="navbar-brand" href="index.php"><img src="imagenes/logo.png" id = "logotipo" alt="logotipo"></a>
          </div>
          <!-- barra de navegación adaptable-->
        <div class="collapse navbar-collapse" id="Navbar">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item dropdown active">
              <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#">HOTELES</a>
                <div class="dropdown-menu">
                  <a class="dropdown-item" href="vista/malaga.php">Málaga</a>
                  <a class="dropdown-item" href="vista/roma.php">Roma</a>
                  <a class="dropdown-item" href="#">Atenas</a>
                  <a class="dropdown-item" href="#">París</a>
                </div>
            <li class="nav-item"><a class="nav-link" href="vista/eventos.php">EVENTOS</a></li>
            <li class="nav-item"><a class="nav-link" href="vista/nosotros.php">NOSOTROS</a></li>
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
                    echo "controlador/control.php?rec=true";
                  //Si el usuario ya se ha logado redirige a su sesión hasta que se cierre el navegador:
                  }elseif (isset($_SESSION["usuario"])){
                    echo "vista/sesion.php?user=ok";
                  //En caso contrario se vuelve al login (Acceder.php):
                  }else{
                    echo "vista/acceder.php";
                  }
                   ?>>
                  <img src="imagenes/user.png" alt="usuario" width="25" height="25">
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
    <!--Fondo de la web-->
    <img id="fondo" src="imagenes/fondo.jpg" alt="imagen arena blanca">
    <div id="cuerpo">
        <!--carrusel de fotografías del destino con bootstrap-->
        <div id="carousel" class="carousel slide mx-auto" data-ride="carousel" data-interval="6000">
          <!--indicadores-->
          <ol class="carousel-indicators">
            <li data-target="#carousel" data-slide-to="0" class="active"></li>
            <li data-target="#carousel" data-slide-to="1"></li>
            <li data-target="#carousel" data-slide-to="2"></li>
            <li data-target="#carousel" data-slide-to="3"></li>
          </ol>
        <!--slideshow-->
        <div class="carousel-inner">
          <div class="carousel-item active">
            <img class="d-block w-100" src="imagenes/index/bienvenida.jpg" alt="Fotografía bienvenida a la habitación">
            <div class="carousel-caption d-md-block text-light">
              <h1>Vive la experiencia</h1>
              <h2>Sientete como en casa</h2>
            </div>
          </div>
          <div class="carousel-item">
            <img class="d-block w-100" src="imagenes/index/hotel1.jpg" alt="">
            <div class="carousel-caption d-md-block text-ligth">
              <h1>Amplias habitaciones</h1>
              <h2>Disfruta de tu estancia</h2>
            </div>
          </div>
          <div class="carousel-item">
            <img class="d-block w-100" src="imagenes/index/viaje.jpg" alt="">
            <div class="carousel-caption d-md-block text-light">
              <h1>Viaja</h1>
              <h2>Haz las maletas</h2>
            </div>
          </div>
          <div class="carousel-item">
            <img class="d-block w-100" src="imagenes/index/stars.jpg" alt="">
            <div class="carousel-caption d-md-block text-light">
              <h1>Destinos exclusivos</h1>
              <h2>Disfruta de europa en nuestros alojamientos de 4 estrellas</h2>
            </div>
          </div>
        </div>
        <!--controles-->
        <a class="carousel-control-prev" href="#carousel" role="button" data-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carousel" role="button" data-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="sr-only">Next</span>
        </a>
        </div>
        <hr>
      <!-- contenedor fluido bootstrap para el ancho de la página -->
        <div class="container-fluid">
            <div class="destacar">
              <form action="controlador/control.php" method="post">
                 <div class="form-row justify-content-center">
                   <div class="col-md-2 col-sm-6">
                    <label for="destino">Destinos</label><br>
                    <select class="form-control" name="destino">
                      <option value="Malaga">Málaga</option>
                      <option value="Roma">Roma</option>
                      <option value="Atenas">Atenas</option>
                      <option value="Paris">París</option>
                    </select>
                  </div>
                  <div class="col-md-2 col-sm-6">
                    <label for="fecha_entrada">Fecha de entrada</label><br>
                    <input type="date" id="date1" class="form-control" name="fecha_entrada" min=<?php echo date("Y-m-d"); ?> required
                    value=<?php
                    //Para mostrar la selección hecha previamente:
                    if(isset($_COOKIE['reserva'])) {echo $a["Entrada"];}
                    ?>>
                  </div>
                  <div class="col-md-2 col-sm-6">
                    <label for="fecha_salida">Fecha de salida</label><br>
                    <input type="date" id="date2" class="form-control" name="fecha_salida" required
                     value=<?php
                     //Para mostrar la selección hecha previamente:
                     if(isset($_COOKIE['reserva'])) {echo $a["Salida"];}?>>
                  </div>
                  <div class="col-md-2 col-sm-6 mt-3 align-self-end">
                    <input type="submit" id="solicitar_precio" class="btn btn-primary" value="Solicita tu Reserva">
                  </div>
                 </div>
                 <?php falloReserva(); ?>
              </form>
          </div>
        <div id = "eligenos">
          <hr>
          <!-- Apartado 1 -->
          <div class="row">
            <div class="col-md-6 col-sm-6">
              <h3>Olvidate de todo</h3>
              <p>En Hoteles Modern Palace nos encargamos de tu bienestar, gracias a nuestros alojamientos
                con una calidad atemporal y unos equipamientos exclusivos que harán que te olvides de todas tus
                preocupaciones durante el tiempo que estés con nosotros.</p>
              <p>Vive el disfrute de los pequeños detalles en ciudades europeas de ensueño como Roma o París.
                Siente la aventura en Atenas y descansa tranquilamente en Málaga. Nuestras premisas por encima de todo son:</p>
              <ul>
                <li>Confort</li>
                <li>Tranquilidad</li>
                <li>Calidez</li>
                <li>Ubicaciones inmejorables</li>
              </ul>
            </div>
              <img class="col-md-6 col-sm-6" src="imagenes/index/habitacion.jpg" alt="imagen de vista desde habitación">
          </div>
          <hr>
          <!-- Apartado 2 -->
          <div class="row">
            <img class="col-md-6 order-md-1 col-12 order-2" src="imagenes/index/experiencia.jpg" alt="Persona fotografiando Vaticano">
            <div class="col-md-6 order-md-2 col-12 order-1">
              <h3>Disfruta la experiencia</h3>
              <p>Contrata nuestros paquetes de experiencias únicas y explora lugares emblemáticos
                del mundo, cena en entornos sumamente cuidados, diviertete a lo grande o simplemente relajate en
                nuestras instalaciones. (Sujetos a la disponibilidad del alojamiento).
              </p>
              <p>Eligenos por nuestro equipamiento:</p>
              <ul>
                <li>Habitaciones desde 20 a 30 m2</li>
                <li>Terrazas con vistas de ensueño</li>
                <li>Servicios de cortesía y atención personalizada</li>
                <li>Baños con duchas de hidromasaje</li>
              </ul>
            </div>
          </div>
        </div>
        <hr>
        <!-- Open Street Maps-->
        <!--Elemento oculto para selección de mapa"-->
        <input type="hidden" id="ciudad" name="destino" value="map">
        <div id="map" class="map">
        </div>
        <hr>
          <!-- Apartado para redes sociales-->
          <div id = "enlaces">
            <h3>Síguenos en redes sociales</h3>
            <!-- Enlaces con imagenes -->
            <div class="row">
              <a class="col enlaceTexto zoom" href="https://es-es.facebook.com/"><img class="enlaces" src="imagenes/facebook.png" alt="acceso facebook"><br>Facebook</a>
              <a class="col enlaceTexto zoom" href="https://www.instagram.com/"><img class="enlaces" src="imagenes/instagram.png" alt="acceso instagram"><br>Instagram</a>
              <a class="col enlaceTexto zoom" href="https://twitter.com/"><img class="enlaces" src="imagenes/twitter.png" alt="acceso twitter"><br>Twitter</a>
              <a class="col enlaceTexto zoom" href="https://es.linkedin.com/"><img class="enlaces" src="imagenes/linkedin.png" alt="acceso linkedin"><br>Linkedin</a>
            </div>
          </div>
          <hr>
      <!-- Pie de página con enlaces, información adicional, etc. -->
      <footer>
        <div id = "pie">
          <div class="row m-4 p-3 align-items-start">
              <a class="col-md-2 col-8 d-block w-100 m-auto order-md-1 order-2" href="#cuerpo"><img src="imagenes/logo.png" id="logopie" alt="logotipo de modernpalace"></a>
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
                <li><a href="vista/malaga.php">Málaga</a></li>
                <li><a href="vista/roma.php">Roma</a></li>
                <li><a href="vista/atenas.php">Atenas</a></li>
                <li><a href="vista/paris.php">París</a></li>
              </ul>
            </div>
            <div class="col-md-2 d-none d-md-block mt-2 order-md-4">
              <h4 class="ml-4">Compañia</h4>
              <ul class="listadosPie">
                <li><a href="vista/nosotros.php">Nosotros</a></li>
                <li><a href="vista/eventos.php">Eventos</a></li>
              </ul>
            </div>
            <div class="col-md-3 d-none d-md-block mt-2 order-md-5">
              <h4 class="ml-4">Síguenos</h4>
              <ul class="listadosPie">
                <li class="zoom"><a href="https://es-es.facebook.com/"><img class="enlacesBlack" src="imagenes/facebookBlack.png" alt="link facebook"></a></li>
                <li class="zoom"><a href="https://www.instagram.com/"><img class="enlacesBlack" src="imagenes/instagramBlack.png" alt="link instagram"></a></li>
                <li class="zoom"><a href="https://twitter.com/"><img class="enlacesBlack" src="imagenes/twitterBlack.png" alt="link twitter"></a></li>
                <li class="zoom"><a href="https://es.linkedin.com/"><img class="enlacesBlack" src="imagenes/linkedinBlack.png" alt="link linkedin"></a></li>
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
    <!--<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>-->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <!-- Leaflet's -->
     <script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js"
       integrity="sha512-gZwIG9x3wUXg2hdXF6+rVkLF/0Vi9U8D2Ntg4Ga5I5BZpVkVxlJWbSQtXPSiUTtC0TjtGOmxa1AJPuV0CPthew=="
       crossorigin=""></script>
    <!-- Declaraciones javascript propias -->
    <script src="js/jQuery.js" type="text/javascript"></script>
    <script src="js/mapa.js" type="text/javascript"></script>
  </body>
</html>
