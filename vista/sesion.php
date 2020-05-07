<?php
//Declaramos el uso del controlador (para uso de funciones) y aplicamos directamente la de seguridad:
include '../controlador/control.php';
seguridad();
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
                  <a class="dropdown-item" href="../vista/malaga.php">Málaga</a>
                  <a class="dropdown-item" href="../vista/roma.php">Roma</a>
                  <a class="dropdown-item" href="#">Atenas</a>
                  <a class="dropdown-item" href="#">París</a>
                </div>
            <li class="nav-item"><a class="nav-link" href="../vista/eventos.php">EVENTOS</a></li>
            <li class="nav-item"><a class="nav-link" href="../vista/nosotros.php">NOSOTROS</a></li>
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
       <div class="row">
           <h4 class="col ml-1">Te damos la bienvenida <?php echo $_SESSION["usuario"];?></h4>
           <div class="col">
             <button class="btn btn-primary float-right"><a href="../controlador/control.php?cierre=true" class="text-light">Cerrar Sesión</a></button>
          </div>
      </div>
         <hr>
        <!--Tabs Bootstrap para separar las áreas del usuario:-->
        <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item">
          <a class="nav-link <?php
          if(isset($_GET["tab"])){
             echo "";
          }else {
            echo "active";
          } ?>" id="reservaAct-tab" data-toggle="tab" href="#reservaAct" role="tab" aria-controls="reserva" aria-selected="true">Reserva en proceso</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" id="reservas-tab" data-toggle="tab" href="#misreservas" role="tab" aria-controls="reservas" aria-selected="false">Mis Reservas</a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?php
          if(isset($_GET["tab"]) && $_GET["tab"] == '3'){
             echo "active";
          } ?>" id="datos-tab" data-toggle="tab" href="#datos" role="tab" aria-controls="datos" aria-selected="false">Datos de contacto</a>
        </li>
      </ul>
      <!--Contenido de las tabs:-->
        <div class="tab-content" id="myTabContent">
          <div class="tab-pane fade <?php
          if(isset($_GET["tab"])){
             echo "";
          }else {
            echo "show active";
          } ?> " id="reservaAct" role="tabpanel" aria-labelledby="reservaAct-tab">
            <br>
            <div class="row justify-content-start ml-1 mr-1 ">
              <div class="resumen col-md-3 col-sm-6 m-2 p-2 align-self">
                <?php
                //Obtenemos los datos anteriores:
                if(isset($_COOKIE['reserva'])) {
                  echo "<table><th>Habitación 1: </th>";
                  $a = usar("reserva");
                  //Imprimimos el contenido del array:
                  foreach ($a as $key => $value) {
                    echo "<tr><td>".$key.": ".$value."</td></tr>";
                  }echo "</table>";
                }else{
                    echo "<p><strong>Sin reservas</strong> pendientes</p>";
                  }
                 ?>
               </table>
               </div>
               <div class="resumen col-md-3 col-sm-6 m-2 p-2 align-self">
                 <?php
                 //Obtenemos los datos anteriores:
                 if(isset($_COOKIE['reserva2'])) {
                   echo "<table><th>Habitación 2: </th>";
                   $b = usar("reserva2");
                   //Imprimimos el contenido del array:
                   foreach ($b as $key => $value) {
                     echo "<tr><td>".$key.": ".$value."</td></tr>";
                   }echo "</table>";
                 }elseif (!isset($_COOKIE['reserva'])) {
                   echo "<img class="."'d-block w-100'"."src="."'../imagenes/nada.jpg'"."alt="."'nada que mostrar'".">";
                 }else{
                   echo "<p><strong>Habitación 2: </strong><br>No</p>";
                 }
                  ?>
                </div>
              </div>
              <br>
            <div class="ml-3">
              <button class="btn btn-primary"><a href="../controlador/control.php?confirmar=true" class="text-light">Confirmar reserva</a></button>
           </div>
         </div>
          <div class="tab-pane fade" id="misreservas" role="tabpanel" aria-labelledby="reservas-tab">
            <div class="row justify-content-start alig-items-center ml-1 mr-1">
                <form action="" method="post">
                  <div class="col m-2 p-2">
                    <label for="IDreservaDel">Seleccione reserva para visualizar:</label>
                    <select class="form-control" id="IDreserva" name="IDreservaDel">
                      <option value="">Selecciona una reserva</option>
                      <?php
                      idReservas();
                      ?>
                    </select>
                    <div class="mt-3">
                     <input type="button" id="eliminaReserva" class="btn btn-primary" value="Eliminar Reserva">
                    </div>
                  </div>
                </form>
                <div id="respuesta" class="col-md-3 col-sm-6 m-2 p-2 mt-4">
                </div>
          </div>
         </div>
          <div class="tab-pane fade <?php
          if(isset($_GET["tab"]) && $_GET["tab"] == '3'){
             echo "show active";
          } ?>" id="datos" role="tabpanel" aria-labelledby="datos-tab">
            <!--Se utiliza la superglobal Session para mostrar los datos del usuario que se encuentra logado por defecto-->
            <div class="ml-4 mr-4 mt-3">
            <p>Visualice sus datos y actualicelos si lo desea:</p>
            </div>
            <div class="row ml-1 mr-1">
            <div class="col-md-2 col-sm-6">
              <form action="../controlador/control.php" method="post">
                <div class="form-group justify-content-center">
                  <div class="">
                    <label for="modUsuario">Usuario (No modificable)</label><br>
                    <input type="text" class="form-control" name="modUsuario" value="<?php echo $_SESSION["usuario"]; ?>" readonly>
                  </div>
                  <div class="">
                    <label for="nombre">Nombre</label><br>
                    <input type="text" class="form-control" name="nombre" value="<?php echo $_SESSION["nombre"]; ?>">
                  </div>
                  <div class="">
                    <label for="apellidos">Apellidos</label><br>
                    <input type="text" class="form-control" name="apellidos" value="<?php echo $_SESSION["apellidos"]; ?>">
                  </div>
                </div>
                </div>
                <div class="col-md-2 col-sm-6">
                  <div class="">
                    <label for="email">Correo electrónico</label><br>
                    <input type="text" class="form-control" name="email" value="<?php echo $_SESSION["email"]; ?>">
                  </div>
                  <div class="">
                    <label for="telefono">Teléfono</label><br>
                    <input type="text" class="form-control" name="telefono" value="<?php echo $_SESSION["telefono"]; ?>">
                  </div>
                  <br>
                  <div class="form-check">
                    <input type="checkbox" class="form-check-input" name="publicidad" value="si"
                    <?php
                    if (isset($_SESSION["publicidad"]) && $_SESSION["publicidad"] == "si"){
                      echo "checked";}
                    ?>>
                    <label for="publicidad" class="form-check-label">¿Desea recibir información comercial?</label>
                  </div>
                  <div class="">
                    <input type="submit" id="actualizaDatos" class="btn btn-primary mt-3" value="Actualizar datos">
                  </div>
              </form>
            </div>
             </div>
          </div>
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
