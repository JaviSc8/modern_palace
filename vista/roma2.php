<?php
  //Declaramos el uso de cookies:
  include '../controlador/cookies.php';
  //Declaramos el uso de las funciones de aviso:
  include '../controlador/avisos.php';
  //Declaramos el uso de sesión del usuario:
    session_start();
    //Si la cookie reserva o datos están definidas, decodificamos para utilizar su información:
    if(isset($_COOKIE['reserva'])) {
      $a = usar('reserva');
    }
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
    <!-- Declaración Leaflet -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.6.0/dist/leaflet.css"
   integrity="sha512-xwE/Az9zrjBIphAcBb3F6JVqxf46+CDLwfLMHloNu6KEQCAWi6HcDUbeOfBIptF7tcCzusKFjFw2yuvEpDL9wQ=="
   crossorigin=""/>
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
              <li class="nav-item dropdown active">
                <!--Elemento desplegable con destinos-->
                <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#">HOTELES</a>
                  <div class="dropdown-menu">
                    <a class="dropdown-item" href="../vista/malaga.php">Málaga</a>
                    <a class="dropdown-item" href="../vista/roma.php">Roma</a>
                    <a class="dropdown-item" href="../vista/atenas.php">Atenas</a>
                    <a class="dropdown-item" href="../vista/paris.php">París</a>
                  </div>
              <!--Elementos simples-->
              <li class="nav-item"><a class="nav-link" href="eventos.php">EVENTOS</a></li>
              <li class="nav-item"><a class="nav-link" href="nosotros.php">NOSOTROS</a></li>
            </ul>
            <!--Información adicional (Teléfono, correo electrónico)-->
              <ul class="navbar-nav">
                <li class="nav-item"><a class="nav-link" href="tel:+34952004417">(+34) 952 00 44 17 </a></li>
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
        <!--Carrusel de fotografías del destino con bootstrap-->
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
          <!--Elemento del carrusel: Imagen, y sus textos-->
          <div class="carousel-item active">
            <img class="d-block w-100" src="../imagenes/roma/roma1.jpg" alt="Fotografía calles de Roma">
            <div class="carousel-caption d-md-block">
              <h1>Vive Roma</h1>
              <h2 class="d-none d-md-block">Sus calles milenarias</h2>
            </div>
          </div>
          <!--Elemento del carrusel: Imagen, y sus textos-->
          <div class="carousel-item">
            <img class="d-block w-100" src="../imagenes/roma/roma2.jpg" alt="Fotografía Fontana di Trevi">
            <div class="carousel-caption d-md-block">
              <h1>Disfruta Roma</h1>
              <h2 class="d-none d-md-block">Su arquitectura</h2>
            </div>
          </div>
          <!--Elemento del carrusel: Imagen, y sus textos-->
          <div class="carousel-item">
            <img class="d-block w-100" src="../imagenes/roma/roma3.jpg" alt="Fotografía Coliseo">
            <div class="carousel-caption d-md-block">
              <h1>Sueña en Roma</h1>
              <h2 class="d-none d-md-block">Viaja a otra época</h2>
            </div>
          </div>
          <!--Elemento del carrusel: Imagen, y sus textos-->
          <div class="carousel-item">
            <img class="d-block w-100" src="../imagenes/roma/roma4.jpg" alt="Fotografía interior iglesia">
            <div class="carousel-caption d-md-block">
              <h1>Visita Roma</h1>
              <h2 class="d-none d-md-block">Pierdete en sus monumentos</h2>
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
      <!-- Contenedor fluido bootstrap para ocupar el ancho de la página -->
      <div class="container-fluid">
        <!--Nombre del hotel-->
        <div id="titulo">
          <h3 class="text-center">Modern Palace Roma</h3>
          <hr>
          <!--Información-->
          <div class="row info">
            <!--Información del Destino/Hotel-->
            <div class="col-12 col-md-3">
              <h4 class="text-center">Roma eterna  <img class="enlacesBlack" src="../imagenes/mundo.png" alt="Icono mundo"></h4>
              <p>Visita Roma, la ciudad eterna, una de las capitales más importantes de la antigüedad. Deleitate con sus monumentos y disfruta
              de su gastronomía. Nuestro hotel se encuentra cerca del Coliseo, por lo que tendrás acceso a los lugares más importantes y a gran
            cantidad de medios de transporte públicos que te permitiran moverte por la ciudad.</p>
            </div>
            <!--Descripción del equipamiento del hotel-->
            <div class="col-12 col-md-3">
              <h4 class="text-center">Equipamiento Hotel <img class="enlacesBlack" src="../imagenes/hotel.png" alt="Icono hotel"></h4>
              <p>Nuestro hotel dispone de:</p>
                <ul>
                  <li>Habitaciones simples y dobles</li>
                  <li>Terraza-bar chill-out</li>
                  <li>Restaurante buffet</li>
                  <li>Aparcamiento</li>
                  <li>Wifi</li>
                </ul>
            </div>
            <!--Descripción del equipamiento de las habitaciones-->
            <div class="col-12 col-md-3">
            <h4 class="text-center">Equipamiento Habitación <img class="enlacesBlack" src="../imagenes/habitacion.png" alt="Icono habitacion"></h3>
            <p>Todas nuestras habitaciones disponen de:</p>
             <ul>
               <li>Baños individuales con duchas hidromasaje</li>
               <li>Caja fuerte</li>
               <li>TV 32"</li>
               <li>Escritorio</li>
               <li>Zonas relax con sofa y terraza</li>
             </ul>
             </div>
            <!--Div que recoge los datos del tiempo del script tiempo.js-->
            <div id="datos" class="col-12 col-md-3">
              <h4>Tiempo hoy <img class="enlacesBlack" src="../imagenes/temp.png" alt="Icono termómetro/temperatura"></h4>
            </div>
          </div>
        </div>
        <hr>
        <div class="destacar info">
          <h4>Habitación 2:</h4>
          <!--Formulario para reserva de habitación-->
          <form action="../controlador/control.php" method="post">
            <!--Elemento oculto para usar el destino en reservas, tiempo y mapa-->
            <input type="hidden" id="ciudad" name="destino2" value="Roma,IT">
            <div class="form-row justify-content-center">
              <!--Selección de fecha de entrada-->
              <div class="col-md-2 col-sm-6">
                <label for="date1">Fecha de entrada</label><br>
                <input type="date" id="date1" class="form-control" name="fecha_entrada" min=<?php echo date("Y-m-d"); ?> required
                value=<?php
                //Para mostrar la selección hecha previamente:
                if(isset($_COOKIE['reserva'])) {
                  echo $a["Entrada"]." readonly";
                }
                ?>>
              </div>
              <!--Selección de fecha de salida-->
              <div class="col-md-2 col-sm-6">
                <label for="date2">Fecha de salida</label><br>
                <input type="date" id="date2" class="form-control" name="fecha_salida" required
                value=<?php
                //Para mostrar la selección hecha previamente:
                if(isset($_COOKIE['reserva'])) {
                  echo $a["Salida"]." readonly";
                }
                ?>>
              </div>
              <!--Selección de nº de adultos-->
              <div class="col-md-2 col-sm-6">
                <label for="adultos">Nº Adultos por Hab.</label>
                <select class="form-control" id="adultos" name="adultos">
                  <option value="1">1</option>
                  <option class="option" value="2">2</option>
                  <option class="option" value="3">3</option>
                </select>
              </div>
              <!--Botón para enviar formulario-->
              <div class="col-md-2 col-sm-6 mt-3 align-self-end">
                <input type="submit" class="btn btn-primary" value="Continuar">
            </div>
          </div>
        <hr>
      <div class="row">
        <!--Fotografía de habitación-->
        <img class="habitaciones col-md-3 col-sm-6" src="../imagenes//habitaciones/habitacionsimple.jpg" alt="habitacion simple">
        <!--Información de la habitación-->
        <div class="col-md-9 col-sm-6">
        <h4>Habitación Simple</h4>
          <p>Habitaciones simples, tranquilas y funcionales ubicadas en un entorno acogedor, equipadas y diseñadas para garantizar el máximo confort.
            <br>
            - Tamaño de la habitación: <strong>20m2 aprox.</strong>
            <br>
            - Ocupación máxima: <strong>1 adulto/hab.*</strong></p>
            <!--Checks para seleccionar tipo de habitación y regimen -->
              <div class="form-check">
                <input class="form-check-input simple" type="radio" name="regimen" id="Radios1" value="simpleDesayuno">
                <label class="form-check-label" for="Radios1">
                  Alojamiento con Desayuno Buffet incluido. <strong>Precio por noche: 60 €*</strong>
                </label>
              </div>
              <div class="form-check">
                <input class="form-check-input simple" type="radio" name="regimen" id="Radios2" value="simpleMedia">
                <label class="form-check-label" for="Radios2">
                  Alojamiento en régimen de Media Pensión (Desayuno y Cena Buffet). <strong>Precio por noche: 90 €*</strong>
                </label>
              </div>
        </div>
      </div>
      <hr>
      <div class="row">
        <!--Fotografía de habitación-->
        <img class="habitaciones col-md-3 col-sm-6" src="../imagenes//habitaciones/habitaciondoble.jpg" alt="habitacion doble">
        <!--Información de la habitación-->
        <div class="col-md-9 col-sm-6">
        <h4>Habitación Doble</h4>
          <p>Habitaciones dobles, tranquilas y funcionales para disfrutar en la mejor compañia, equipadas y diseñadas para garantizar el máximo confort.
            <br>
            - Tamaño de la habitación: <strong>30m2 aprox.</strong>
            <br>
            - Ocupación máxima: <strong>3 adultos/hab.*</strong></p>
            <!--Checks para seleccionar tipo de habitación y regimen -->
            <div class="form-check">
              <input class="form-check-input doble" type="radio" name="regimen" id="Radios3" value="dobleDesayuno" checked>
              <label class="form-check-label" for="Radios3">
                Alojamiento con Desayuno Buffet incluido. <strong>Precio por noche: 130 €*</strong>
              </label>
            </div>
            <div class="form-check">
              <input class="form-check-input doble" type="radio" name="regimen" id="Radios4" value="dobleMedia">
              <label class="form-check-label" for="Radios4">
                Alojamiento en régimen de Media Pensión (Desayuno y Cena Buffet). <strong>Precio por noche: 190 €*</strong>
              </label>
            </div>
        </div>
      </div>
    </form>
    <hr>
    <!--Aclaraciones sobre ocupación y precio-->
    <p class="aclaracion">* Ocupación: 1 Niño/a de hasta 14 años sin coste adicional en habitación simple y 2 niños/as en habitación doble (sofa/cama supletoria/s disponibles).
    <br>* Precio: En temporada alta (Junio a Agosto, ambos inclusive), el precio se verá incrementado 20 € por noche.</p>
    </div>
  <hr>
  <!-- Open Street Maps-->
  <div id="Roma" class="map">
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
                <li><a href="tel:+34952004417">(+34) 952 00 44 17 </a></li>
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
   <!-- Leaflet's (Mapas) -->
    <script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js"
      integrity="sha512-gZwIG9x3wUXg2hdXF6+rVkLF/0Vi9U8D2Ntg4Ga5I5BZpVkVxlJWbSQtXPSiUTtC0TjtGOmxa1AJPuV0CPthew=="
      crossorigin=""></script>
   <!-- Declaraciones javascript propias -->
   <script src="../js/jQuery.js" type="text/javascript"></script>
   <script src="../js/tiempo.js" type="text/javascript"></script>
   <script src="../js/mapa.js" type="text/javascript"></script>
   <!--Aviso por habitaciones no disponibles en la fecha seleccionada (Lo ponemos al final para que cargue la página)-->
   <?php falloHabitacion(); ?>
  </body>
</html>
