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
   $consultarUsuario2=$base->consulta($_POST["nuevoUsuario"]);
    if (mysqli_num_rows($consultarUsuario2) > 0) {
      header('Location: ../vista/registro.php?falloUsuario=true');
    }elseif ($_POST["password"]!=$_POST["password2"]) {
      header('Location: ../vista/registro.php?falloPass=true');
    }else{
      //Codificacion de contraseña, inserción del registro en tabla usuarios de la base de datos y vuelta a acceder.php:
        $contraseña = password_hash($_POST["password"], PASSWORD_DEFAULT);
        $base->insertar($_POST["nuevoUsuario"], $_POST["nombre"], $_POST["apellidos"], $contraseña, $_POST["email"]);
        header('Location: ../vista/acceder.php');
    }
  }
  //------------------------------------------------------------------------
  //ACCEDER.PHP: Login de usuario con comprobaciones de usuario y password:
  if (isset($_POST["usuario"])) {
    $consultarUsuario=$base->consulta($_POST["usuario"]);
    //Comprobación de usuario (nº de filas devueltas por la consulta):
    if (mysqli_num_rows($consultarUsuario) == 0){
      //Se accede al fallo mediante GET:
      header('Location: ../vista/acceder.php?falloUsuario=true');
    }else{
  /*Obtenemos datos mediante while y usamos la superglobal Session para comprobar password y mostrar datos
  posteriormente en SESION.PHP si todo va bien:*/
      while($row = mysqli_fetch_assoc($consultarUsuario)){
        $_SESSION["usuario"] = $row["usuario"];
        $_SESSION["nombre"] = $row["nombre"];
        $_SESSION["apellidos"] = $row["apellidos"];
        $_SESSION["password"] = $row["password"];
        $_SESSION["email"] = $row["email"];
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
    $consultarUsuario2=$base->consulta($datos["Usuario"]);
    /*Obtenemos datos mediante while y usamos la superglobal Session para comprobar password y mostrar datos
    posteriormente en SESION.PHP si todo va bien:*/
    while($row = mysqli_fetch_assoc($consultarUsuario2)){
      $_SESSION["usuario"] = $row["usuario"];
      $_SESSION["nombre"] = $row["nombre"];
      $_SESSION["apellidos"] = $row["apellidos"];
      $_SESSION["password"] = $row["password"];
      $_SESSION["email"] = $row["email"];
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
  //SESION.PHP: Consulta de reservas del cliente registrado:
  function misReservas(){
    $baseDatos=new consultas();
    $mireserva = [];
    $consultaReserva = $baseDatos->miReserva($_SESSION["usuario"]);
    $cuentafilas = mysqli_num_rows($consultaReserva);
    //Si el número de filas de la consulta es superior a 0 se muestra en una tabla los datos de reserva:
    if ($cuentafilas > 0) {
      //Obtenemos los datos mediante while y mysqli_fetch_assoc:
      while($row = mysqli_fetch_assoc($consultaReserva)){
        $mireserva["Id Reserva"] = $row["IdReserva"];
        $mireserva["Destino"] = $row["nombre"];
        $mireserva["Tipo Habitacion"] = $row["Tipo"];
        $mireserva["Regimen Alojamiento"] = $row["Regimen"];
        $mireserva["Fecha de entrada"] = $row["fecha_entrada"];
        $mireserva["Fecha de salida"] = $row["fecha_salida"];
        $mireserva["Número de adultos"] = $row["num_adultos"];
      //return print_r( $mireserva);
        echo "<table><th>Reservas confirmada: </th>";
      //Imprimimos el contenido del array:
        foreach ($mireserva as $key => $value) {
          echo "<tr><td>".$key.": ".$value."</td></tr>";
        }
        echo "</table>";
      }
      //De lo contrario se muestra el mensaje "Sin reservas confirmadas":
    }else {
      echo "<p><strong>Sin reservas</strong> confirmadas</p>";
    }
  }
//SESION.PHP: Confirmación de reserva:
if(isset($_GET["confirmar"]) && $_GET["confirmar"] == 'true'){
  if (isset($_COOKIE["reserva"])) {
    $a = usar("reserva");
    $idHab1 = $base->idHabitacion($a["Destino"], $a["Tipo"], $a["Regimen"]);
    //Obtenemos los datos mediante while y fetch_assoc:
    while($row = mysqli_fetch_assoc($idHab1)){
      $_SESSION["idHabitacion1"] = $row["IdHabitacion"];
    }
    $base->reserva($_SESSION["usuario"], $_SESSION["idHabitacion1"], $a["Fecha entrada"], $a["Fecha salida"], $a["Adultos"], $a["Precio total"]);
    eliminar("reserva");
  }
  if (isset($_COOKIE["reserva2"])) {
    $b = usar("reserva2");
    $idHab2 = $base->idHabitacion($b["Destino"], $b["Tipo"], $b["Regimen"]);
    //Obtenemos los datos mediante while y fetch_assoc:
    while($row = mysqli_fetch_assoc($idHab2)){
      $_SESSION["idHabitacion2"] = $row["IdHabitacion"];
    }
    $base->reserva($_SESSION["usuario"], $_SESSION["idHabitacion2"], $b["Fecha entrada"], $b["Fecha salida"], $b["Adultos"], $b["Precio total"]);
    eliminar("reserva2");
  }
  header('Location: ../vista/sesion.php?user=ok');
}
//SESION.PHP: Actualizar datos del cliente en base de datos:
if (isset($_POST["modUsuario"])) {
  $base->actualizar($_POST["modUsuario"], $_POST["nombre"], $_POST["apellidos"], $_POST["email"]);
  $_SESSION = [];
  $consultarUsuario3=$base->consulta($_POST["modUsuario"]);
  //Obtenemos los datos mediante while y usamos la superglobal Session para mostrar los nuevos datos en sesion.php:
  while($row = mysqli_fetch_assoc($consultarUsuario3)){
    $_SESSION["usuario"] = $row["usuario"];
    $_SESSION["nombre"] = $row["nombre"];
    $_SESSION["apellidos"] = $row["apellidos"];
    $_SESSION["email"] = $row["email"];
  }
header('Location: ../vista/sesion.php?user=ok');
}
//SESION.PHP: Destrucción de variables de sesión al pulsar cierre de sesión:
if(isset($_GET["cierre"]) && $_GET["cierre"] == 'true'){
  $_SESSION = [];
  //Destrucción de la sesión:
  session_destroy();
  //Eliminar cookie con los datos usados en recuerdame:
  eliminar("datos");
  //Vuelta al index:
  header('Location: ../vista/acceder.php');
};
//---------------------------------------
//DESTINOS y comienzo de RESERVAS: Almacenamiento de variables en cookies y selección de url destino:
/*Si tenemos el destino pero no el tipo de habitación y regimen añadimos el contenido basico y
remitimos a la página del destino (caso del INDEX:PHP):*/
if (isset($_POST["destino"]) && !isset($_POST["regimen"])) {
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
//Si tenemos el destino añadimos la información de que vamos disponiendo (caso de que el cliente se dirija directamente al "DESTINO.PHP")
  if (isset($_POST["destino"])) {
    $habitacion1->contenido();
    $habitacion1->crear("reserva");
  }
    //Si se almacena la reserva al completo se introduce el precio y se remite a la reserva de una segunda habitación:
  if (isset($_POST["regimen"]) && !isset($_POST["destino2"])) {
    //Añadir el precio consultado a la base de datos a la variable reserva:
    $contenidoPrecio=$base->precio($_POST["destino"], $habitacion1->tipoHab, $habitacion1->regimen);
    while($row = mysqli_fetch_assoc($contenidoPrecio)){
      $habitacion1->reserva["Precio noche"] = $row["precio"];
    }
    $habitacion1->insertaPrecio();
    $habitacion1->crear("reserva");
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
    }else {
      //Redireccionamiento:
      if(isset($_COOKIE["datos"])){
        header('Location: control.php?rec=true');
      }else {
        header('Location: ../vista/acceder.php');
      }
    }
  }
  //Segunda habitación, se completa con los datos del formulario y los precios y se reenvia al inicio de sesión para gestionar la reserva.
if (isset($_POST["destino2"])) {
  $_POST["destino"] = $_POST["destino2"];
  $habitacion2->contenido();
  //Añadir el precio consultado a la base de datos a la variable reserva:
  $contenidoPrecio=$base->precio($_POST["destino"], $habitacion2->tipoHab, $habitacion2->regimen);
  while($row = mysqli_fetch_assoc($contenidoPrecio)){
    $habitacion2->reserva["Precio noche"] = $row["precio"];
  }
  $habitacion2->insertaPrecio();
  $habitacion2->crear("reserva2");
  //Redireccionamiento:
  if(isset($_COOKIE["datos"])){
    header('Location: control.php?rec=true');
  }else {
    header('Location: ../vista/acceder.php');
  }
}
//----------------------------------------------


 ?>
