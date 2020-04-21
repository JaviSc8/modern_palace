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
    <!--<img id="fondo" src="../imagenes/fondo.jpg" alt="fondo paisaje">-->
    <!-- contenedor fluido bootstrap para toda la página -->
    <div id="cuerpo" class="container-fluid">
      <hr>
     <div class="destacar">
       <div class="row">
           <h4 class="col">Te damos la bienvenida <?php echo $_SESSION["usuario"];?></h4>
           <div class="col">
             <button class="btn btn-primary float-right"><a href="../controlador/control.php?cierre=true" class="text-light">Cerrar Sesión</a></button>
          </div>
      </div>
         <hr>
        <!--Tabs Bootstrap para separar las áreas del usuario:-->
        <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item">
          <a class="nav-link active" id="reservaAct-tab" data-toggle="tab" href="#reservaAct" role="tab" aria-controls="reserva" aria-selected="true">Reserva en proceso</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" id="reservas-tab" data-toggle="tab" href="#misreservas" role="tab" aria-controls="reservas" aria-selected="false">Mis Reservas</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" id="datos-tab" data-toggle="tab" href="#datos" role="tab" aria-controls="datos" aria-selected="false">Datos de contacto</a>
        </li>
      </ul>
      <!--Contenido de las tabs:-->
        <div class="tab-content" id="myTabContent">
          <div class="tab-pane fade show active" id="reservaAct" role="tabpanel" aria-labelledby="reservaAct-tab">
            <br>
            <div class="d-flex justify-content-start ">
              <div class="resumen align-self">
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
                    echo "<p><strong>Sin reservas</strong> en proceso </p>";
                  }
                 ?>
               </table>
               </div>
               <div class="resumen align-self">
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
                   echo "<img src="."../imagenes/nada.jpg"." alt="."nada que mostrar".">";
                 }else{
                   echo "<p><strong>Habitación 2: </strong><br>No</p>";
                 }
                  ?>
                </div>
              </div>
              <br>
            <div class="">
              <button class="btn btn-primary separacion"><a href="../controlador/control.php?confirmar=true" class="text-light">Confirmar reserva</a></button>
           </div>
         </div>
          <div class="tab-pane fade" id="misreservas" role="tabpanel" aria-labelledby="reservas-tab">
            <?php
            misReservas();
             ?>
          </div>
          <div class="tab-pane fade" id="datos" role="tabpanel" aria-labelledby="datos-tab">
            <!--Se utiliza la superglobal Session para mostrar los datos del usuario que se encuentra logado por defecto-->
            <h5>Datos del usuario:</h5>
            <div class="row">
            <div class="col-2">
              <form action="../controlador/control.php" method="post">
                <div class="form-group justify-content-center">
                  <div class="">
                    <label for="modUsuario">Usuario (No modificable)</label><br>
                    <input type="text" class="form-control" name="modUsuario" value="<?php echo $_SESSION["usuario"]; ?>" readonly>
                  </div>
                  <div class="">
                    <label for="email">Correo electrónico</label><br>
                    <input type="text" class="form-control" name="email" value="<?php echo $_SESSION["email"]; ?>">
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
                <div class="">
                  <input type="submit" class="btn btn-primary" value="Actualizar datos">
                </div>
              </form>
            </div>
             </div>
          </div>
        </div>
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
    <script src="js/jQuery.js" type="text/javascript"></script>
  </body>
</html>
