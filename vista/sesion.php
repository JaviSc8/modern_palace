<?php
//Declaramos el uso del controlador (para uso de funciones) y aplicamos directamente la de seguridad:
include '../controlador/control.php';
//Declaramos el uso de las funciones de aviso:
include '../controlador/avisos.php';
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
            <li class="nav-item"><a class="nav-link" href="../vista/eventos.php">EVENTOS</a></li>
            <li class="nav-item"><a class="nav-link" href="../vista/nosotros.php">NOSOTROS</a></li>
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
    <img id="fondo" src="../imagenes/fondo.jpg" alt="imagen arena blanca">
    <!-- Contenedor fluido bootstrap para ocupar el ancho de la página -->
    <div id="cuerpo" class="container-fluid">
      <hr>
    <!--Mensaje de bienvenida y botón de cierre de sesión-->
     <div class="destacar">
       <!--Mensaje de bienvenida con nombre del usuario que ha iniciado sesión-->
       <div class="row">
           <h4 class="col ml-1">Te damos la bienvenida <?php echo $_SESSION["usuario"];?></h4>
           <!--Botón de cierre de sesión, al pulsarlo borra la sesión, eliimna la cookie datos si existe, destruye la sesión y sale a acceder.php-->
           <div class="col">
             <button class="btn btn-primary float-right"><a href="../controlador/control.php?cierre=true" class="text-light">Cerrar Sesión</a></button>
          </div>
      </div>
         <hr>
        <!--Tabs Bootstrap para separar las áreas del usuario:-->
        <ul class="nav nav-tabs" id="myTab" role="tablist">
        <!--Selector de tabs. Tab 1. Reservas en proceso-->
        <li class="nav-item">
          <!--Por defecto se muestra tab 1 (Reservas en proceso), pero si se actualizan los datos del usuario (tab 3) no se imprime active para que se
          imprima en dicha tab y aparezca seleccionada al cargar la página-->
          <a class="nav-link <?php
          if(isset($_GET["tab"])){
             echo "";
          }else {
            echo "active";
          } ?>" id="reservaAct-tab" data-toggle="tab" href="#reservaAct" role="tab" aria-controls="reserva" aria-selected="true">Reserva en proceso</a>
        </li>
        <!--Selector de tabs. Tab 2. Mis reservas-->
        <li class="nav-item">
          <a class="nav-link" id="reservas-tab" data-toggle="tab" href="#misreservas" role="tab" aria-controls="reservas" aria-selected="false">Mis Reservas</a>
        </li>
        <!--Selector de tabs. Tab 3. Datos del usuario-->
        <li class="nav-item">
          <!--Si el controlador devuelve que se utilice la tab 3 (tras actualizar datos), se imprime active, por lo que se muestra seleccionada esta tab-->
          <a class="nav-link <?php
          if(isset($_GET["tab"]) && $_GET["tab"] == '3'){
             echo "active";
          } ?>" id="datos-tab" data-toggle="tab" href="#datos" role="tab" aria-controls="datos" aria-selected="false">Datos de acceso y contacto</a>
        </li>
      </ul>
      <!--Contenido de las tabs:-->
        <div class="tab-content" id="myTabContent">
          <!-- TAB 1. Por defecto se muestra tab 1 (Reservas en proceso), pero si se actualizan los datos del usuario (tab 3) no se imprime show active para que se
          imprima en dicha tab y se muestre al cargar la página-->
          <div class="tab-pane fade <?php
          if(isset($_GET["tab"])){
             echo "";
          }else {
            echo "show active";
          } ?> " id="reservaAct" role="tabpanel" aria-labelledby="reservaAct-tab">
            <br>
            <!--Apartados con información de las reservas en curso-->
            <div class="row justify-content-start ml-1 mr-1 ">
              <!--Datos de habitación 1-->
              <div class="resumen col-md-3 col-sm-6 m-2 p-2 align-self">
                <?php
                //Obtenemos los datos anteriores y los mostramos en una tabla:
                if(isset($_COOKIE['reserva'])) {
                  echo "<table><th>Habitación 1: </th>";
                  $a = usar("reserva");
                  //Imprimimos el contenido del array en la tabla:
                  foreach ($a as $key => $value) {
                    echo "<tr><td>".$key.": ".$value."</td></tr>";
                  }echo "</table>";
                }else{
                    echo "<p><strong>Sin reservas</strong> pendientes</p>";
                  }
                 ?>
               </table>
               </div>
               <!--Datos de habitación 2-->
               <div class="resumen col-md-3 col-sm-6 m-2 p-2 align-self">
                 <?php
                 //Obtenemos los datos anteriores y los mostramos en una tabla:
                 if(isset($_COOKIE['reserva2'])) {
                   echo "<table><th>Habitación 2: </th>";
                   $b = usar("reserva2");
                   //Imprimimos el contenido del array en la tabla:
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
              <!--Aclaración sobre el pago y precio total-->
              <p class="aclaracion">* Pago: Se efectuará en el alojamiento tras cotejar su identidad mediante DNI/Pasaporte.
                <br>* Precio Total: En temporada alta (Junio a Agosto, ambos inclusive), el precio se verá incrementado 20 € por noche.</p>
            <!--Botón para confirmar la reserva y almacenarla en la base de datos-->
            <div class="ml-3">
              <button class="btn btn-primary"><a href="
              <?php
              if (isset($_COOKIE['reserva'])){
                echo "../controlador/control.php?confirmar=true";
              }else{
                echo "../vista/sesion.php?user=ok&res=ko";
              }
              ?>" class="text-light">Confirmar reserva</a></button>
           </div>
         </div>
         <!-- TAB 2. Mis reservas: Se muestran las reservas del usuario que se encuentran almacenadas en la base de datos y permite eliminarlas de una en una-->
          <div class="tab-pane fade" id="misreservas" role="tabpanel" aria-labelledby="reservas-tab">
            <div class="row justify-content-start alig-items-center ml-1 mr-1">
              <!--Formulario con un desplegable para seleccionar de entre las reservas existentes, y un botón para eliminar la reserva escogida-->
                <form action="" method="post">
                  <!--Selector que muestra las reservas de la base de datos confirmadas por el usuario-->
                  <div class="col m-2 p-2">
                    <label for="IDreserva">Seleccione reserva para visualizar:</label>
                    <select class="form-control" id="IDreserva" name="IDreservaDel">
                      <option value="">Selecciona una reserva</option>
                      <?php
                      //Función de control.php que consulta los IDs de las reservas confirmadas por el usuario para rellenar el selector
                      idReservas();
                      ?>
                    </select>
                    <!--Botón para eliminar la reserva escogida de la base de datos mediante uso de AJAX (jQuery.js) y control.php-->
                    <div class="mt-3">
                     <input type="button" id="eliminaReserva" class="btn btn-primary" value="Eliminar Reserva">
                    </div>
                  </div>
                </form>
                <!--Espacio donde se muestra la información de la reserva escogida en el selector-->
                <div id="respuesta" class="col-md-3 col-sm-6 m-2 p-2 mt-4">
                </div>
          </div>
         </div>
         <!-- TAB 3. Datos de acceso y contacto del usuario: Se muestran los datos de contacto del usuario que se encuentran almacenadas en la base de datos y permite actualizar estos y la contraseña-->
          <div class="tab-pane fade <?php
          //Si se actualizan los datos, se imprime show active para que la tab se muestre tras la carga de la página
          if(isset($_GET["tab"]) && $_GET["tab"] == '3'){
             echo "show active";
          } ?>" id="datos" role="tabpanel" aria-labelledby="datos-tab">
            <div class="ml-4 mr-4 mt-3">
            <p>Visualice sus datos y actualicelos si lo desea:</p>
            </div>
            <div class="row ml-1 mr-1">
            <div class="col-md-2 col-sm-6 border-left">
              <!--Formulario que utiliza la superglobal Session para mostrar los datos del usuario que se encuentra logado-->
              <form action="../controlador/control.php" method="post">
                <div class="form-group justify-content-center">
                  <!--Área de texto con Nombre de usuario (no se puede modificar)-->
                  <div>
                    <label for="modUsuario">Usuario (No modificable)</label><br>
                    <input type="text" id="modUsuario" class="form-control" name="modUsuario" value="<?php echo $_SESSION["usuario"]; ?>" readonly>
                  </div>
                  <!--Área de texto con Nombre-->
                  <div>
                    <label for="nombre">Nombre</label><br>
                    <input type="text" id="nombre" class="form-control" name="nombre" value="<?php echo $_SESSION["nombre"]; ?>" required>
                  </div>
                  <!--Área de texto con Apellidos-->
                  <div>
                    <label for="apellidos">Apellidos</label><br>
                    <input type="text" id="apellidos" class="form-control" name="apellidos" value="<?php echo $_SESSION["apellidos"]; ?>" required>
                  </div>
                </div>
                <!--Check de publicidad, si lo marcó al registrarse aparece como marcado-->
                <div class="form-check">
                  <input type="checkbox" id="info_com" class="form-check-input" name="publicidad" value="si"
                  <?php
                  if (isset($_SESSION["publicidad"]) && $_SESSION["publicidad"] == "si"){
                    echo "checked";}
                  ?>>
                  <label for="info_com" class="form-check-label">¿Desea recibir información comercial?</label>
                </div>
                </div>
                <!--Área de texto con Correo electrónico-->
                <div class="col-md-2 col-sm-6">
                  <div>
                    <label for="email">Correo electrónico</label><br>
                    <input type="text" id="email" class="form-control" name="email" value="<?php echo $_SESSION["email"]; ?>" required>
                  </div>
                  <!--Área de texto con Teléfono-->
                  <div>
                    <label for="telefono">Teléfono</label><br>
                    <input type="text" id="telefono" class="form-control" name="telefono" value="<?php echo $_SESSION["telefono"]; ?>" required>
                  </div>
                  <!--Botón para enviar formulario y actualizar los datos de contacto en la base de datos-->
                  <div>
                    <input type="submit" class="btn btn-primary mt-3" value="Actualizar datos">
                  </div>
                  <br>
              </form>
            </div>
            <!-- Formulario para actualizar la contraseña del usuario -->
            <div class="col-md-2 col-sm-6 border-left">
              <form action="../controlador/control.php" method="post">
                <!--Introducción de contraseña actual-->
                <div>
                  <label for="oldpassword">Contraseña actual</label><br>
                  <input type="password" id="oldpassword" class="form-control" name="oldpassword" required>
                </div>
                <!--Introducción de contraseña nueva-->
                <div>
                  <label for="newpassword">Contraseña nueva</label><br>
                  <input type="password" id="newpassword" class="form-control" name="newpassword" required>
                </div>
                <!--Botón para enviar formulario y actualizar la contraseña en la base de datos-->
                <div>
                  <input type="submit" class="btn btn-primary mt-3" value="Actualizar contraseña">
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
    <!-- Declaraciones opcionales relacionadas con Bootstrap -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <!-- Declaraciones javascript propias -->
    <script src="../js/jQuery.js" type="text/javascript"></script>
    <!--Avisos (Lo ponemos al final para que cargue la página)-->
    <?php avisoSesion(); ?>
  </body>
</html>
