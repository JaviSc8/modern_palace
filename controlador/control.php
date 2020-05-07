<?php
session_start();
require '../modelo/consultas.php';
require '../modelo/cookies.php';
//Nuevo objeto para realizar conexiones con base de datos:
$base=new consultas();
//Nuevo objeto para crear cookie:
$habitacion1=new cookies();
$habitacion2=new cookies();
//-----------------------------------------------------------------------
 //REGISTRO.PHP: Nuevo registro de usuario, con comprobaciones de usuario y contraseña:
 if (isset($_POST["nuevoUsuario"])) {
   $consultarUsuario1=$base->consulta($_POST["nuevoUsuario"]);
   //Comprobación de usuario y redirección al fallo:
    if (mysqli_num_rows($consultarUsuario1) > 0) {
      header('Location: ../vista/registro.php?falloUsuario=true');
      //Comprobación de password y redirección al fallo:
    }elseif ($_POST["password"]!=$_POST["password2"]) {
      header('Location: ../vista/registro.php?falloPass=true');
    }else{
      //Codificacion de contraseña, inserción del registro en tabla usuarios de la base de datos y vuelta a acceder.php:
        $contraseña = password_hash($_POST["password"], PASSWORD_DEFAULT);
        $base->insertar($_POST["nuevoUsuario"], $_POST["nombre"], $_POST["apellidos"], $contraseña, $_POST["email"], $_POST["telefono"], $_POST["publicidad"]) ;
        header('Location: ../vista/acceder.php');
    }
  }
  //------------------------------------------------------------------------
  //ACCEDER.PHP: Login de usuario con comprobaciones de usuario y password:
  if (isset($_POST["usuario"])) {
    $consultarUsuario2=$base->consulta($_POST["usuario"]);
    //Comprobación de usuario (nº de filas devueltas por la consulta):
    if (mysqli_num_rows($consultarUsuario2) == 0){
      //Se accede al fallo mediante GET:
      header('Location: ../vista/acceder.php?falloUsuario=true');
    }else{
  /*Obtenemos datos mediante while y usamos la superglobal Session para comprobar password y mostrar datos
  posteriormente en SESION.PHP si todo va bien:*/
      while($row = mysqli_fetch_assoc($consultarUsuario2)){
        $_SESSION["usuario"] = $row["usuario"];
        $_SESSION["nombre"] = $row["nombre"];
        $_SESSION["apellidos"] = $row["apellidos"];
        $_SESSION["password"] = $row["password"];
        $_SESSION["email"] = $row["email"];
        $_SESSION["telefono"] = $row["telefono"];
        $_SESSION["publicidad"] = $row["publicidad"];
      }
        //Para almacenar el usuario y la contraseña en una cookie:
        if ($_POST["recuerda"] == 1) {
          recordarUsuario();
        }
        //Comprobación del password con password_verify:
        if (password_verify($_POST["password"], $_SESSION["password"])) {
            header('Location: ../vista/sesion.php?user=ok');
          }else{
            //Se accede al fallo mediante GET:
            header('Location: ../vista/acceder.php?falloPass=true');
          }
    }
  }
//Login automático: Si existe la cookie con el password el cliente entra directamente a SESIÓN.PHP pinchando en ACCEDER.PHP:
  if(isset($_GET["rec"]) && $_GET["rec"] == 'true' && isset($_COOKIE["datos"])) {
    //Se decodifica la cookie y se realiza la consulta a la base de datos para comprobar password:
    $datos=usar("datos");
    $consultarUsuario3=$base->consulta($datos["Usuario"]);
    /*Obtenemos datos mediante while y usamos la superglobal Session para comprobar password y mostrar datos
    posteriormente en SESION.PHP si todo va bien:*/
    while($row = mysqli_fetch_assoc($consultarUsuario3)){
      $_SESSION["usuario"] = $row["usuario"];
      $_SESSION["nombre"] = $row["nombre"];
      $_SESSION["apellidos"] = $row["apellidos"];
      $_SESSION["password"] = $row["password"];
      $_SESSION["email"] = $row["email"];
      $_SESSION["telefono"] = $row["telefono"];
      $_SESSION["publicidad"] = $row["publicidad"];
      //Si la comprobación del password es correcta se cambia el id de sesión al de la cookie, se inicia y se regenera uno nuevo por seguridad:
      if ($datos["Pw"] === $_SESSION["password"]) {
          session_id($datos["ID"]);
          session_start();
          session_regenerate_id();
          //Se almacena el nuevo id junto con los datos del usuario nuevamente y se redirige a la sesión de este:
          recordarUsuario();
          header('Location: ../vista/sesion.php?user=ok');
      }
    }
  }
  //-------------------------------------------------------------------------------
  //SESION.PHP: Redireccionamiento por seguridad:
  function seguridad(){
    if (!isset($_GET["user"]) && $_GET["user"] != "ok") {
      header('Location: ../vista/acceder.php');
    }
  }
  //SESION.PHP/RESERVA EN PROCESO: Confirmación de reserva:
  if(isset($_GET["confirmar"]) && $_GET["confirmar"] == 'true'){
    if (isset($_COOKIE["reserva"])) {
      $a = usar("reserva");
      $idHab1 = $base->idHabitacion($a["Destino"], $a["Tipo"], $a["Regimen"]);
      //Obtenemos los datos mediante while y fetch_assoc:
      while($row = mysqli_fetch_assoc($idHab1)){
        $_SESSION["idHabitacion1"] = $row["IdHabitacion"];
      }
      $base->reserva($_SESSION["usuario"], $_SESSION["idHabitacion1"], $a["Entrada"], $a["Salida"], $a["Adultos"], $a["Precio_total"]);
      eliminar("reserva");
    }
    if (isset($_COOKIE["reserva2"])) {
      $b = usar("reserva2");
      $idHab2 = $base->idHabitacion($b["Destino"], $b["Tipo"], $b["Regimen"]);
      //Obtenemos los datos mediante while y fetch_assoc:
      while($row = mysqli_fetch_assoc($idHab2)){
        $_SESSION["idHabitacion2"] = $row["IdHabitacion"];
      }
      $base->reserva($_SESSION["usuario"], $_SESSION["idHabitacion2"], $b["Entrada"], $b["Salida"], $b["Adultos"], $b["Precio_total"]);
      eliminar("reserva2");
    }
    header('Location: ../vista/sesion.php?user=ok');
  }
  //SESION.PHP/MIS RESERVAS: Consulta del ID de reservas del cliente registrado para mostrarlo en select:
function idReservas(){
  $baseDatos=new consultas();
  $miIDreserva = [];
  $consultaIDReserva = $baseDatos->IDReserva($_SESSION["usuario"]);
  $cuentafilas = mysqli_num_rows($consultaIDReserva);
  //Si el número de filas de la consulta es superior a 0 se muestra en una tabla los datos de reserva:
  if ($cuentafilas > 0) {
    //Obtenemos los datos mediante while y mysqli_fetch_assoc:
    while($row = mysqli_fetch_assoc($consultaIDReserva)){
      $miIDreserva["Id Reserva"] = $row["IdReserva"];
    //Imprimimos el contenido del array en el selector de Sesion.php:
      foreach ($miIDreserva as $key => $value) {
        echo "<option value=".$value.">".$key.": ".$value."</option>";
      }
    }
    //De lo contrario se muestra el mensaje "Sin reservas confirmadas":
    }else {
       echo "<option>Sin reservas</option>";
    }
}
  //SESION.PHP/MIS RESERVAS: Consulta de reservas del cliente registrado:
  if (isset($_POST["IDreserva"])) {
    $mireserva = [];
    $consultaReserva = $base->miReservaID($_POST["IDreserva"]);
      //Obtenemos los datos mediante while y mysqli_fetch_assoc:
      while($row = mysqli_fetch_assoc($consultaReserva)){
        $mireserva["Destino"] = $row["nombre"];
        $mireserva["Tipo Habitacion"] = $row["Tipo"];
        $mireserva["Regimen Alojamiento"] = $row["Regimen"];
        $mireserva["Fecha de entrada"] = $row["fecha_entrada"];
        $mireserva["Fecha de salida"] = $row["fecha_salida"];
        $mireserva["Número de adultos"] = $row["num_adultos"];
        $mireserva["Precio Reserva"] = $row["PrecioDef"];
      }
      echo "<div class="."'resumen p-2 align-self'"."><table><th>Datos de reserva: </th>";
      foreach ($mireserva as $key => $value) {
        echo "<tr><td>".$key.": ".$value."</td></tr>";
      }
      echo "</table></div>";
    }
    //SESION.PHP/MIS RESERVAS: Eliminar reserva seleccionada:
    if (isset($_POST["IDreservaDel"])) {
      $consultaReserva = $base->delReserva($_POST["IDreservaDel"]);
      header('Location: ../vista/sesion.php?user=ok&tab=2');
    }
//SESION.PHP/DATOS DE CONTACTO: Actualizar datos del cliente en base de datos:
if (isset($_POST["modUsuario"])) {
  $base->actualizar($_POST["modUsuario"], $_POST["nombre"], $_POST["apellidos"], $_POST["email"], $_POST["telefono"], $_POST["publicidad"]) ;
  $consultarUsuario4=$base->consulta($_POST["modUsuario"]);
  //Obtenemos los datos mediante while y usamos la superglobal Session para mostrar los nuevos datos en sesion.php:
  while($row = mysqli_fetch_assoc($consultarUsuario4)){
    $_SESSION["usuario"] = $row["usuario"];
    $_SESSION["nombre"] = $row["nombre"];
    $_SESSION["apellidos"] = $row["apellidos"];
    $_SESSION["email"] = $row["email"];
    $_SESSION["telefono"] = $row["telefono"];
    $_SESSION["publicidad"] = $row["publicidad"];
  }
header('Location: ../vista/sesion.php?user=ok&tab=3');
}
//SESION.PHP: Destrucción de variables al pulsar cierre de sesión:
if(isset($_GET["cierre"]) && $_GET["cierre"] == 'true'){
  $_SESSION = [];
  //Destrucción de la sesión:
  session_destroy();
  //Eliminar cookie con los datos usados en recuerdame:
  eliminar("datos");
  //Vuelta al login:
  header('Location: ../vista/acceder.php');
};
//---------------------------------------
//DESTINOS y comienzo de RESERVAS: Almacenamiento de variables en cookies y selección de url destino:
/*Si tenemos el destino pero no el tipo de habitación y regimen añadimos el contenido basico y
remitimos a la página del destino (caso del INDEX:PHP):*/
if (isset($_POST["destino"]) && !isset($_POST["regimen"])) {
  $consultaDisponibilidad = $base->disponibilidad($_POST["fecha_entrada"], $_POST["fecha_salida"]);
  $cuentafilas = mysqli_num_rows($consultaDisponibilidad);
  //Si el número de filas de la consulta es igual a 30 (Max. de habitaciones), se remite a la página de nuevo con el mensaje de error:
  if ($cuentafilas == 30) {
    header('Location: ../index.php?reserva=ko');
  }else{
    $habitacion1->contenido();
    $habitacion1->crear("reserva");
    switch ($_POST["destino"]) {
      case 'Malaga':
        header('Location: ../vista/malaga.php');
        break;
      case 'Roma':
        header('Location: ../vista/roma.php');
        break;
      case 'Atenas':
        header('Location: ../vista/atenas.php');
        break;
      case 'Paris':
        header('Location: ../vista/paris.php');
        break;
    }
  }
}
/*DESTINO.PHP: Primera habitación. Se completa con los datos del formulario, se comprueba disponibilidad, se completan los precios,
 se gestiona la solicitud de una segunda habitación y se reenvia al inicio de sesión para gestionar la reserva.*/
  if (isset($_POST["regimen"]) && !isset($_POST["destino2"])) {
    habitacion($habitacion1, "reserva", 10, 20, "");
  }
/*DESTINO.PHP: Segunda habitación. Se completa con los datos del formulario, se comprueba disponibilidad,
se completan los precios y se reenvia al inicio de sesión para gestionar la reserva.*/
if (isset($_POST["destino2"])) {
  $_POST["destino"] = $_POST["destino2"];
  habitacion($habitacion2, "reserva2", 9, 19, "2");}
//----------------------------------------------
//DESTINO.PHP. Función para utilizar a la hora de crear las cookies de reserva tras el envío de formularios.
function habitacion($objCookie, $nombreCookie, $habMaxSimple, $habMaxDoble, $redireccion) {
  $baseDatos=new consultas();
  $objCookie=new cookies();
  $objCookie->contenido();
  //Se comprueba disponibilidad mediante switch. Para hab. simple:
  switch ($objCookie->tipoHab) {
    case 'simple':
        $DisponibilidadSimple = $baseDatos->disponibilidadSimple($_POST["fecha_entrada"], $_POST["fecha_salida"]);
        $cuentafilas = mysqli_num_rows($DisponibilidadSimple);
        //Si el número de filas de la consulta es igual a 10 (Max. de habitaciones simples - la hab. anterior), se remite a la página de nuevo con el mensaje de error:
        if ($cuentafilas == $habMaxSimple) {
          switch ($_POST["destino"]) {
            case 'Malaga':
              header('Location: ../vista/malaga'.$redireccion.'.php?simple=ko#datos');
              break;
            case 'Roma':
              header('Location: ../vista/roma'.$redireccion.'.php?simple=ko#datos');
              break;
            case 'Atenas':
              header('Location: ../vista/atenas'.$redireccion.'.php?simple=ko#datos');
              break;
            case 'Paris':
              header('Location: ../vista/paris'.$redireccion.'.php?simple=ko#datos');
              break;
          }
        }else{
          //Añadir el precio consultado a la base de datos a la variable reserva:
          $contenidoPrecio=$baseDatos->precio($_POST["destino"], $objCookie->tipoHab, $objCookie->regimen);
          while($row = mysqli_fetch_assoc($contenidoPrecio)){
            $objCookie->reserva["Precio_noche"] = $row["precio"];
          }
          $objCookie->insertaPrecio();
          $objCookie->crear($nombreCookie);
          //Remitir a la página con la segunda habitación de reserva si se marca la opción:
          if ($_POST["habitacion"] == "si") {
              switch ($_POST["destino"]) {
                case 'Malaga':
                  header('Location: ../vista/malaga2.php#datos');
                  break;
                case 'Roma':
                  header('Location: ../vista/roma2.php#datos');
                  break;
                case 'Atenas':
                  header('Location: ../vista/atenas2.php#datos');
                  break;
                case 'Paris':
                  header('Location: ../vista/paris2.php#datos');
                  break;
              }
          }else{
          //Redireccionamiento: Si el usuario ya está recordado por la cookie previa se verifica:
          if(isset($_COOKIE["datos"])){
            header('Location: control.php?rec=true');
            //Si el usuario ya se ha logado anteriormente se redirige a su sesión hasta que se cierre el navegador:
          }elseif (isset($_SESSION["usuario"])) {
            header('Location: ../vista/sesion.php?user=ok');
            //Se envía al login, Acceder.php:
          }else {
            header('Location: ../vista/acceder.php');
          }
        }
      }
    break;
    //Se comprueba disponibilidad mediante switch. Para hab. doble:
    case 'doble':
        $DisponibilidadDoble = $baseDatos->disponibilidadDoble($_POST["fecha_entrada"], $_POST["fecha_salida"]);
        $cuentafilas = mysqli_num_rows($DisponibilidadDoble);
        //Si el número de filas de la consulta es igual a 19 (Max. de habitaciones dobles - la hab. anterior), se remite a la página de nuevo con el mensaje de error:
        if ($cuentafilas == $habMaxDoble) {
          switch ($_POST["destino"]) {
            case 'Malaga':
              header('Location: ../vista/malaga'.$redireccion.'.php?doble=ko#datos');
              break;
            case 'Roma':
              header('Location: ../vista/roma'.$redireccion.'.php?doble=ko#datos');
              break;
            case 'Atenas':
              header('Location: ../vista/atenas'.$redireccion.'.php?doble=ko#datos');
              break;
            case 'Paris':
              header('Location: ../vista/paris'.$redireccion.'.php?doble=ko#datos');
              break;
          }
        }else{
          //Añadir el precio consultado a la base de datos a la variable reserva:
          $contenidoPrecio=$baseDatos->precio($_POST["destino"], $objCookie->tipoHab, $objCookie->regimen);
          while($row = mysqli_fetch_assoc($contenidoPrecio)){
            $objCookie->reserva["Precio_noche"] = $row["precio"];
          }
          $objCookie->insertaPrecio();
          $objCookie->crear($nombreCookie);
          //Remitir a la página con la segunda habitación de reserva si se marca la opción:
          if ($_POST["habitacion"] == "si") {
              switch ($_POST["destino"]) {
                case 'Malaga':
                  header('Location: ../vista/malaga2.php#datos');
                  break;
                case 'Roma':
                  header('Location: ../vista/roma2.php#datos');
                  break;
                case 'Atenas':
                  header('Location: ../vista/atenas2.php#datos');
                  break;
                case 'Paris':
                  header('Location: ../vista/paris2.php#datos');
                  break;
              }
          }else{
          //Redireccionamiento: Si el usuario ya está recordado por la cookie previa se verifica:
          if(isset($_COOKIE["datos"])){
            header('Location: control.php?rec=true');
            //Si el usuario ya se ha logado anteriormente se redirige a su sesión hasta que se cierre el navegador:
          }elseif (isset($_SESSION["usuario"])) {
            header('Location: ../vista/sesion.php?user=ok');
            //Se envía al login, Acceder.php:
          }else {
            header('Location: ../vista/acceder.php');
          }
        }
      }
    break;
  }
}
 ?>
