<?php
//Declaramos el uso de cookies:
  include '../modelo/cookies.php';
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
                  echo "../controlador/control.php?rec=true";
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
    <!--Fondo de la web-->
    <!--<img id="fondo" src="../imagenes/fondo.jpg" alt="fondo paisaje">-->
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
            <img class="d-block w-100" src="../imagenes/malaga/malaga1.jpg" alt="Fotografía Málaga 1">
            <div class="carousel-caption d-md-block">
              <h1>Disfruta de Málaga</h1>
              <h2>Siente sus calles centenarias</h2>
            </div>
          </div>
          <div class="carousel-item">
            <img class="d-block w-100" src="../imagenes/malaga/malaga2.jpg" alt="Fotografía Málaga 2">
            <div class="carousel-caption d-none d-md-block mx-auto">
              <h1>Vive Málaga</h1>
              <h2>Contempla su atardecer</h2>
            </div>
          </div>
          <div class="carousel-item">
            <img class="d-block w-100" src="../imagenes/malaga/catedral2.jpg" alt="Fotografía catedral de Málaga">
            <div class="carousel-caption d-none d-md-block">
              <h1>Observa Málaga</h1>
              <h2>Admira su arquitectura</h2>
            </div>
          </div>
          <div class="carousel-item">
            <img class="d-block w-100" src="../imagenes/malaga/mar.jpg" alt="Fotografía del mar en Málaga">
            <div class="carousel-caption d-none d-md-block">
              <h1>Sumergete en Málaga</h1>
              <h2>Vive el mar en todo su esplendor</h2>
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
      <!-- contenedor fluido bootstrap para toda la página -->
      <div class="container-fluid">
        <!--Div que recoge los datos del tiempo del script tiempo.js-->
        <div id="datos" class="destacar">
        </div>
        <hr>
        <div class="destacar">
          <h4>Habitación 2:</h4>
          <form action="../controlador/control.php" method="post">
            <!--Elemento oculto para el destino "Málaga"-->
            <input type="hidden" id="ciudad" name="destino2" value="Malaga">
            <div class="form-row justify-content-center">
              <div class="col-2">
                <label for="fecha_entrada">Fecha de entrada</label><br>
                <input type="date" class="form-control" name="fecha_entrada" min=<?php echo date("Y-m-d"); ?> required
                value=<?php //Para mostrar la selección hecha previamente:
                if(isset($_COOKIE['reserva'])) {
                  echo $a["Fecha entrada"]." readonly";
                }
                ?>>
              </div>
              <div class="col-2">
                <label for="fecha_salida">Fecha de salida</label><br>
                <input type="date" class="form-control" name="fecha_salida" min=<?php echo date("Y-m-d"); ?> required
                value=<?php //Para mostrar la selección hecha previamente:
                if(isset($_COOKIE['reserva'])) {
                  echo $a["Fecha salida"]." readonly";
                }
                ?>>
              </div>
              <div class="col-2">
                <label for="adultos">Nº Adultos por Hab.</label>
                <select class="form-control" name="adultos">
                  <option value="1">1</option>
                  <option value="2">2</option>
                  <option value="3">3</option>
                </select>
              </div>
              <div class="col-2 align-self-end">
                <input type="submit" id="solicitar_precio" class="btn btn-primary" value="Continuar">
            </div>
          </div>
        <hr>
      <div class="row">
        <!--Fotografía de habitación-->
        <img class="habitaciones col-3" src="../imagenes/habitaciones/habitacionsimple.jpg" alt="habitacion simple">
        <div class="col-9">
        <h4>Habitación Simple</h4>
          <p>Habitaciones simples, tranquilas y funcionales ubicadas en un entorno acogedor, equipadas y diseñadas para garantizar el máximo confort.
            Tamaño de la habitación: <strong>20m2 aproximadamente</strong></p>
            <fieldset class="form-group">
              <div class="form-check">
                <input class="form-check-input" type="radio" name="regimen" id="Radios1" value="simpleDesayuno">
                <label class="form-check-label" for="Radios1">
                  Alojamiento con Desayuno Buffet incluido
                </label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="radio" name="regimen" id="Radios2" value="simpleMedia">
                <label class="form-check-label" for="Radios2">
                  Alojamiento en régimen de Media Pensión (Desayuno y Cena Buffet)
                </label>
              </div>
            </fieldset>
        </div>
      </div>
      <hr>
      <div class="row">
        <!--Fotografía de habitación-->
        <img class="habitaciones col-3" src="../imagenes/habitaciones/habitaciondoble.jpg" alt="habitacion doble">
        <div class="col-9">
        <h4>Habitación Doble</h4>
          <p>Habitaciones dobles, tranquilas y funcionales para disfrutar en la mejor compañia, equipadas y diseñadas para garantizar el máximo confort.
            Tamaño de la habitación: <strong>30m2 aproximadamente</strong></p>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="regimen" id="Radios3" value="dobleDesayuno" checked>
              <label class="form-check-label" for="Radios3">
                Alojamiento con Desayuno Buffet incluido
              </label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="regimen" id="Radios4" value="dobleMedia">
              <label class="form-check-label" for="Radios4">
                Alojamiento en régimen de Media Pensión (Desayuno y Cena Buffet)
              </label>
            </div>
        </div>
      </div>
    </form>
    </div>
    <hr>
    <!-- Google Maps -->
    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d102341.80869077441!2d-4.519306960919692!3d36.71820148344484!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xd7259c44fdb212d%3A0x6025dc92c9ca32cf!2zTcOhbGFnYQ!5e0!3m2!1ses!2ses!4v1585388775690!5m2!1ses!2ses"
    width="100%" height="450" frameborder="0" style="border:0; border-radius: 15px;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
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
     </div>
     </footer>
     </div>
   </div>
   <!-- Declaraciones opcionales relacionadas con Bootstrap -->
   <!-- jQuery first, then Popper.js, then Bootstrap JS -->
   <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
   <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
   <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
   <!-- Declaraciones javascript propias -->
   <script src="js/jQuery.js" type="text/javascript"></script>
   <script src="../js/tiempo.js" type="text/javascript"></script>
  </body>
</html>
