<?php
/*Habilitamos buffer de salida para evitar problemas con redirecciones tipo header() evitando que se envíe contenido
que no sea un header hasta que se indique el cierre del buffer:*/
ob_start();

//Declaramos el uso de sesión del usuario:
session_start();

//Requerimos el uso de consultas.php (para utilizar información de base de datos) y cookies.php (para hacer uso de ellas):
require '../modelo/consultas.php';
require '../controlador/cookies.php';

//Nuevo objeto para realizar conexiones con base de datos:
$base=new consultas();

//Nuevos objetos para crear cookies para las reservas de habitación:
$habitacion1=new cookies();
$habitacion2=new cookies();

//------------------------------------------------------------------------------
 //REGISTRO.PHP: Nuevo registro de usuario, con comprobaciones de usuario y contraseña:
 /*Si la variable "nuevoUsuario" está definida, se consulta si existe el usuario en base de datos en primer lugar, mediante la devolución del nº de filas,
 después se comprueba que las contraseñas coinciden y finalmente se guarda el usuario en la base de datos con la contraseña codificada mediante hash:*/
 if (isset($_POST["nuevoUsuario"])) {
   $consultarUsuario1=$base->consulta($_POST["nuevoUsuario"]);
   //Comprobación de usuario y redirección al fallo:
    if (mysqli_num_rows($consultarUsuario1) > 0) {
      header('Location: ../vista/registro.php?falloUsuario=true');
      //Cerramos buffer tras header:
      ob_end_flush();
      //Comprobación de password y redirección al fallo:
    }elseif ($_POST["password"]!=$_POST["password2"]) {
      header('Location: ../vista/registro.php?falloPass=true');
      //Cerramos buffer tras header:
      ob_end_flush();
    }else{
      //Codificacion de contraseña, inserción del registro en tabla usuarios de la base de datos y vuelta a acceder.php:
        $contraseña = password_hash($_POST["password"], PASSWORD_DEFAULT);
        $base->insertar($_POST["nuevoUsuario"], $_POST["nombre"], $_POST["apellidos"], $contraseña, $_POST["email"], $_POST["telefono"], $_POST["publicidad"]) ;
        header('Location: ../vista/acceder.php?registro=ok');
        //Cerramos buffer tras header:
        ob_end_flush();
    }
  }
  //----------------------------------------------------------------------------
  //ACCEDER.PHP:
  /*LOGIN DE USUARIO con comprobaciones de usuario y password:Si la variable "usuario" se encuentra definida, se comprueba el usuario mediante la devolución
  de filas de la base de datos, se obtienen todos los datos y se asignan a la superglobal $_SESSION para mostrar en sesion.php. Si se marca la opción para
  recordar usuario se crea la cookie "datos" con los datos del usuario. Se comprueba el password y se permite el acceso a sesion.php si todo va bien*/
  if (isset($_POST["usuario"])) {
    $consultarUsuario2=$base->consulta($_POST["usuario"]);
    //Comprobación de usuario (nº de filas devueltas por la consulta):
    if (mysqli_num_rows($consultarUsuario2) == 0){
      //Se accede al fallo mediante GET:
      header('Location: ../vista/acceder.php?falloUsuario=true');
      //Cerramos buffer tras header:
      ob_end_flush();
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
        //Si el valor de "recuerda" es igual a 1 se utiliza la función de cookies.php para recordar usuario (almacenar el usuario y la contraseña en una cookie)
        if ($_POST["recuerda"] == 1) {
          recordarUsuario();
        }
        //Comprobación del password con password_verify:
        if (password_verify($_POST["password"], $_SESSION["password"])) {
            header('Location: ../vista/sesion.php?user=ok');
            //Cerramos buffer tras header:
            ob_end_flush();
          }else{
            //Se accede al fallo mediante GET:
            header('Location: ../vista/acceder.php?falloPass=true');
            //Cerramos buffer tras header:
            ob_end_flush();
          }
    }
  }
//LOGIN AUTOMÁTICO: Si existe la cookie con el password el cliente entra directamente a SESIÓN.PHP pinchando en ACCEDER.PHP:
//Si está definido "rec", es true y existe la cookie datos:
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
          //Cerramos buffer tras header:
          ob_end_flush();
      //Si la información de la cookie no es correcta se remite a la dirección del controlador que cierra la sesión y reenvia a acceder:
      }else {
        header('Location: control.php?cierre=true');
        //Cerramos buffer tras header:
        ob_end_flush();
      }
    }
  }
//------------------------------------------------------------------------------
//SESION.PHP: Redireccionamiento si se intenta acceder directamente a sesion.php por seguridad:
  function seguridad(){
    //Si no se encuentra la variable "user" y no es "ok" se redirige a acceder.php:
    if (!isset($_GET["user"]) && $_GET["user"] != "ok") {
      header('Location: ../vista/acceder.php');
      //Cerramos buffer tras header:
      ob_end_flush();
    }
  }
//SESION.PHP/RESERVA EN PROCESO: Confirmación de reserva:
  //Si la variable "confirmar" está definida, es true y existen las cookies con la reserva por habitación:
  if(isset($_GET["confirmar"]) && $_GET["confirmar"] == 'true'){
    //Si existe la cookie "reserva" se decodifica y se consulta a la base de datos el id de la habitación
    if (isset($_COOKIE["reserva"])) {
      $a = usar("reserva");
      $idHab1 = $base->idHabitacion($a["Destino"], $a["Tipo"], $a["Regimen"]);
      //Obtenemos los datos mediante while y fetch_assoc:
      while($row = mysqli_fetch_assoc($idHab1)){
        $_SESSION["idHabitacion1"] = $row["IdHabitacion"];
      }
      //Se inserta la reserva en base de datos:
      $base->reserva($_SESSION["usuario"], $_SESSION["idHabitacion1"], $a["Entrada"], $a["Salida"], $a["Adultos"], $a["Precio_total"]);
      //Eliminamos la cookie utilizada:
      eliminar("reserva");
    }
    //Si existe la cookie "reserva2" se decodifica y se consulta a la base de datos el id de la habitación
    if (isset($_COOKIE["reserva2"])) {
      $b = usar("reserva2");
      $idHab2 = $base->idHabitacion($b["Destino"], $b["Tipo"], $b["Regimen"]);
      //Obtenemos los datos mediante while y fetch_assoc:
      while($row = mysqli_fetch_assoc($idHab2)){
        $_SESSION["idHabitacion2"] = $row["IdHabitacion"];
      }
      //Se inserta la reserva en base de datos:
      $base->reserva($_SESSION["usuario"], $_SESSION["idHabitacion2"], $b["Entrada"], $b["Salida"], $b["Adultos"], $b["Precio_total"]);
      //Eliminamos la cookie utilizada:
      eliminar("reserva2");
    }
    //Volvemos a la sesión del usuario indicando que todo esta ok:
    header('Location: ../vista/sesion.php?user=ok&res=ok');
    //Cerramos buffer tras header:
    ob_end_flush();
  }
//SESION.PHP/MIS RESERVAS: Función para consulta de los ID de reservas del cliente registrado para mostrarlo en select:
//Se genera un nuevo objeto para consultas a la base de datos y un array donde almacenar los id de reservas:
function idReservas(){
  $baseDatos=new consultas();
  $miIDreserva = [];
  //Consultamos a la base de datos dichos id:
  $consultaIDReserva = $baseDatos->IDReserva($_SESSION["usuario"]);
  $cuentafilas = mysqli_num_rows($consultaIDReserva);
  //Si el número de filas de la consulta es superior a 0 van completando el select de sesion.php:
  if ($cuentafilas > 0) {
    //Obtenemos los datos mediante while y mysqli_fetch_assoc:
    while($row = mysqli_fetch_assoc($consultaIDReserva)){
      $miIDreserva["Id Reserva"] = $row["IdReserva"];
    //Imprimimos el contenido del array en el selector de Sesion.php:
      foreach ($miIDreserva as $key => $value) {
        echo "<option value=".$value.">".$key.": ".$value."</option>";
      }
    }
    //De lo contrario se muestra el mensaje "Sin reservas":
    }else {
       echo "<option>Sin reservas</option>";
    }
}
  //SESION.PHP/MIS RESERVAS: Consulta de reserva del cliente registrado y visualización por pantalla (mediante AJAX):
  //Si la variable "IdReserva" se encuentra definida, se crea un array para almacenar los datos de la reserva y se consultan dichos datos:
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
      //Se muestran en un div que incluye una tabla, que se va completando con el bucle foreach:
      echo "<div class="."'resumen p-2 align-self'"."><table><th>Datos de reserva: </th>";
      foreach ($mireserva as $key => $value) {
        echo "<tr><td>".$key.": ".$value."</td></tr>";
      }
      echo "</table></div>";
    }
//SESION.PHP/MIS RESERVAS: Eliminar reserva seleccionada (mediante AJAX):
//Si la variable "IDreservaDel" se encuentra definida, se realiza la eliminación de la base de datos y se redirige a sesion.php (tab2):
    if (isset($_POST["IDreservaDel"])) {
      $consultaReserva = $base->delReserva($_POST["IDreservaDel"]);
      header('Location: ../vista/sesion.php?user=ok&tab=2');
      //Cerramos buffer tras header:
      ob_end_flush();
    }
//SESION.PHP/DATOS DE CONTACTO: Actualizar datos del cliente en base de datos:
/*Si la variable "modUsuario" se encuentra definida, se ejecuta la actualización de la base de datos y se asignan los nuevos datos a la superglobal
$_SESSION para que sean mostrados de nuevo en sesion.php (tab3)*/
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
  //Redirección a sesion.php, a tab3, indicando que la actualización ha sido correcta:
header('Location: ../vista/sesion.php?user=ok&tab=3&act=ok');
//Cerramos buffer tras header:
ob_end_flush();
}
//SESION.PHP/DATOS DE ACCESO: Actualizar contraseña del cliente en base de datos:
/*Si la variable "newpassword" se encuentra definida, se consulta la contraseña actual a la base de datos, se verifica y se
ejecuta la actualización de la nueva contraseña codificada en base de datos. Si la cookie "datos" existe se incluye la nueva contraseña.*/
if (isset($_POST["newpassword"])) {
  $consultarUsuario5=$base->consulta($_SESSION["usuario"]);
  /*Obtenemos datos mediante while y usamos la superglobal Session para comprobar password y almacenar datos
  posteriormente en las variables de sesion:*/
      while($row = mysqli_fetch_assoc($consultarUsuario5)){
        $_SESSION["usuario"] = $row["usuario"];
        $_SESSION["nombre"] = $row["nombre"];
        $_SESSION["apellidos"] = $row["apellidos"];
        $_SESSION["password"] = $row["password"];
        $_SESSION["email"] = $row["email"];
        $_SESSION["telefono"] = $row["telefono"];
        $_SESSION["publicidad"] = $row["publicidad"];
      }
        //Comprobación del password actual con password_verify:
        if (password_verify($_POST["oldpassword"], $_SESSION["password"])) {
          //Codificacion de contraseña e inserción del registro en tabla usuarios de la base de datos:
            $contraseñaNew = password_hash($_POST["newpassword"], PASSWORD_DEFAULT);
            $base->actualizarPass($contraseñaNew, $_SESSION["usuario"]);
            //Si existe la cookie "datos" insertamos en ella la nueva contraseña:
            if (isset($_COOKIE["datos"])) {
              $_SESSION["password"] = $contraseñaNew;
              recordarUsuario();
            }
            //Redirección a sesion.php, a tab3, indicando que la actualización del password ha sido correcta:
            header('Location: ../vista/sesion.php?user=ok&tab=3&actPass=ok');
            //Cerramos buffer tras header:
            ob_end_flush();
          }else {
            /*Redirección a sesion.php, a tab3, indicando que la actualización del password ha sido incorrecta si
            las contraseñas actuales no coinciden:*/
            header('Location: ../vista/sesion.php?user=ok&tab=3&actPass=ko');
            //Cerramos buffer tras header:
            ob_end_flush();
          }
        }
//SESION.PHP: Destrucción de variables al pulsar cierre de sesión:
//Si la variable "cierre" está definida y es "true" se borra la superglobal $_SESSION:
if(isset($_GET["cierre"]) && $_GET["cierre"] == 'true'){
  $_SESSION = [];
  //Destrucción de la sesión:
  session_destroy();
  //Eliminamos cookie con los datos usados en recuerdame:
  eliminar("datos");
  //Vuelta al login:
  header('Location: ../vista/acceder.php');
  //Cerramos buffer tras header:
  ob_end_flush();
};
//---------------------------------------
//DESTINOS y comienzo de RESERVAS: Almacenamiento de variables en cookies y selección de url destino:
/*Si tenemos el destino, pero no el tipo de habitación y regimen, añadimos el contenido basico y
remitimos a la página del destino (caso del INDEX:PHP):*/
if (isset($_POST["destino"]) && !isset($_POST["regimen"])) {
  //Consultamos la disponibilidad de habitaciones total del destino (simples y dobles) en base de datos:
  $consultaDisponibilidad = $base->disponibilidad($_POST["fecha_entrada"], $_POST["fecha_salida"], $_POST["destino"]);
  $cuentafilas = mysqli_num_rows($consultaDisponibilidad);
  /*Si el número de filas de la consulta es igual a 30 (Max. de habitaciones), se remite a la página de nuevo con el mensaje de error.
  Si no es igual se crea la cookie "reserva" con el contenido del que se dispone:*/
  if ($cuentafilas == 30) {
    header('Location: ../index.php?reserva=ko');
    //Cerramos buffer tras header:
    ob_end_flush();
  }else{
    $habitacion1->contenido();
    $habitacion1->crear("reserva");
    //Redirigimos hacia la página del destino seleccionado:
    switch ($_POST["destino"]) {
      case 'Malaga,ES':
        header('Location: ../vista/malaga.php');
        //Cerramos buffer tras header:
        ob_end_flush();
        break;
      case 'Roma,IT':
        header('Location: ../vista/roma.php');
        //Cerramos buffer tras header:
        ob_end_flush();
        break;
      case 'Atenas,GR':
        header('Location: ../vista/atenas.php');
        //Cerramos buffer tras header:
        ob_end_flush();
        break;
      case 'Paris,FR':
        header('Location: ../vista/paris.php');
        //Cerramos buffer tras header:
        ob_end_flush();
        break;
    }
  }
}
/*DESTINO.PHP: Primera habitación. Regimen se encuentra definido pero no el 2º destino. Se completa con los datos del formulario,
se comprueba disponibilidad, se completan los precios, se gestiona la solicitud de una segunda habitación y se reenvia al inicio de
sesión para gestionar la reserva.*/
  if (isset($_POST["regimen"]) && !isset($_POST["destino2"])) {
    habitacion($habitacion1, "reserva", 10, 20, "");
//Se elimina la cookie relacionada con una segunda habitación por si existiera de una visita a la web anterior:
    eliminar("reserva2");
  }
/*DESTINO.PHP: Segunda habitación. Se encuentra definido "destino2". En primer lugar, se obtiene el tipo de habitación seleccionada en la primera
habitación mediante su cookie y se establecen los límites de habitación según este tipo. Se completa el contenido de la cookie de la segunda habitación
con los datos del formulario, se comprueba disponibilidad y precios, se crea la cookie y se reenvia al inicio de sesión para gestionar la reserva.*/
if (isset($_POST["destino2"])) {
  $_POST["destino"] = $_POST["destino2"];
   $datosReserva=usar("reserva");
    switch ($datosReserva["Tipo"]) {
    case 'simple':
      habitacion($habitacion2, "reserva2", 9, 20, "2");
    break;
    case 'doble':
      habitacion($habitacion2, "reserva2", 10, 19, "2");
    break;
  }
}
//------------------------------------------------------------------------------
//DESTINO.PHP. Función para utilizar a la hora de crear las cookies de reserva tras el envío de formularios.
function habitacion($objCookie, $nombreCookie, $habMaxSimple, $habMaxDoble, $redireccion) {
  //Se utiliza un objeto nuevo para realizar consultas a la base de datos y otro para utilizar cookies:
  $baseDatos=new consultas();
  $objCookie=new cookies();
  //Se introduce contenido en la cookie:
  $objCookie->contenido();
  //Se comprueba disponibilidad mediante switch. Para hab. simple:
  switch ($objCookie->tipoHab) {
    case 'simple':
    //Consulta a la base de datos sobre la disponibilidad:
        $DisponibilidadSimple = $baseDatos->disponibilidadSimple($_POST["fecha_entrada"], $_POST["fecha_salida"], $_POST["destino"]);
        $cuentafilas = mysqli_num_rows($DisponibilidadSimple);
        /*Si el número de filas de la consulta es igual a 10 o 9 (Max. de habitaciones simples o max. - la hab. anterior), se remite a la página de nuevo
        con el mensaje de error:*/
        if ($cuentafilas == $habMaxSimple) {
          switch ($_POST["destino"]) {
            case 'Malaga,ES':
              header('Location: ../vista/malaga'.$redireccion.'.php?simple=ko#titulo');
              //Cerramos buffer tras header:
              ob_end_flush();
              break;
            case 'Roma,IT':
              header('Location: ../vista/roma'.$redireccion.'.php?simple=ko#titulo');
              //Cerramos buffer tras header:
              ob_end_flush();
              break;
            case 'Atenas,GR':
              header('Location: ../vista/atenas'.$redireccion.'.php?simple=ko#titulo');
              //Cerramos buffer tras header:
              ob_end_flush();
              break;
            case 'Paris,FR':
              header('Location: ../vista/paris'.$redireccion.'.php?simple=ko#titulo');
              //Cerramos buffer tras header:
              ob_end_flush();
              break;
          }
        }else{
          //De lo contrario, añadimos el precio consultado a la base de datos a la variable reserva:
          $contenidoPrecio=$baseDatos->precio($_POST["destino"], $objCookie->tipoHab, $objCookie->regimen);
          while($row = mysqli_fetch_assoc($contenidoPrecio)){
            $objCookie->reserva["Precio_noche"] = $row["precio"];
          }
          $objCookie->insertaPrecio();
          //Creamos la cookie:
          $objCookie->crear($nombreCookie);
          //Remitimos a la página con la segunda habitación de reserva si se marca la opción:
          if ($_POST["habitacion"] == "si") {
              switch ($_POST["destino"]) {
                case 'Malaga,ES':
                  header('Location: ../vista/malaga2.php#titulo');
                  //Cerramos buffer tras header:
                  ob_end_flush();
                  break;
                case 'Roma,IT':
                  header('Location: ../vista/roma2.php#titulo');
                  //Cerramos buffer tras header:
                  ob_end_flush();
                  break;
                case 'Atenas,GR':
                  header('Location: ../vista/atenas2.php#titulo');
                  //Cerramos buffer tras header:
                  ob_end_flush();
                  break;
                case 'Paris,FR':
                  header('Location: ../vista/paris2.php#titulo');
                  //Cerramos buffer tras header:
                  ob_end_flush();
                  break;
              }
          }else{
          //Si no se marca la segunda habitación, se utiliza el siguiente redireccionamiento:
          //Si el usuario ya está recordado por la cookie previa se verifica:
          if(isset($_COOKIE["datos"])){
            header('Location: control.php?rec=true');
            //Cerramos buffer tras header:
            ob_end_flush();
            //Si el usuario ya se ha logado anteriormente se redirige a su sesión hasta que se cierre el navegador:
          }elseif (isset($_SESSION["usuario"])) {
            header('Location: ../vista/sesion.php?user=ok');
            //Cerramos buffer tras header:
            ob_end_flush();
            //Se envía al login, Acceder.php:
          }else {
            header('Location: ../vista/acceder.php');
            //Cerramos buffer tras header:
            ob_end_flush();
          }
        }
      }
    break;
    //Se comprueba disponibilidad mediante switch. Para hab. doble:
    case 'doble':
    //Consulta a la base de datos sobre la disponibilidad:
        $DisponibilidadDoble = $baseDatos->disponibilidadDoble($_POST["fecha_entrada"], $_POST["fecha_salida"], $_POST["destino"]);
        $cuentafilas = mysqli_num_rows($DisponibilidadDoble);
        /*Si el número de filas de la consulta es igual a 20 o 19 (Max. de habitaciones dobles o max. - la hab. anterior), se remite a la página de nuevo
        con el mensaje de error:*/
        if ($cuentafilas == $habMaxDoble) {
          switch ($_POST["destino"]) {
            case 'Malaga,ES':
              header('Location: ../vista/malaga'.$redireccion.'.php?doble=ko#titulo');
              //Cerramos buffer tras header:
              ob_end_flush();
              break;
            case 'Roma,IT':
              header('Location: ../vista/roma'.$redireccion.'.php?doble=ko#titulo');
              //Cerramos buffer tras header:
              ob_end_flush();
              break;
            case 'Atenas,GR':
              header('Location: ../vista/atenas'.$redireccion.'.php?doble=ko#titulo');
              //Cerramos buffer tras header:
              ob_end_flush();
              break;
            case 'Paris,FR':
              header('Location: ../vista/paris'.$redireccion.'.php?doble=ko#titulo');
              //Cerramos buffer tras header:
              ob_end_flush();
              break;
          }
        }else{
          //De lo contrario, añadimos el precio consultado a la base de datos a la variable reserva:
          $contenidoPrecio=$baseDatos->precio($_POST["destino"], $objCookie->tipoHab, $objCookie->regimen);
          while($row = mysqli_fetch_assoc($contenidoPrecio)){
            $objCookie->reserva["Precio_noche"] = $row["precio"];
          }
          $objCookie->insertaPrecio();
          //Creamos la cookie:
          $objCookie->crear($nombreCookie);
          //Remitimos a la página con la segunda habitación de reserva si se marca la opción:
          if ($_POST["habitacion"] == "si") {
              switch ($_POST["destino"]) {
                case 'Malaga,ES':
                  header('Location: ../vista/malaga2.php#titulo');
                  //Cerramos buffer tras header:
                  ob_end_flush();
                  break;
                case 'Roma,IT':
                  header('Location: ../vista/roma2.php#titulo');
                  //Cerramos buffer tras header:
                  ob_end_flush();
                  break;
                case 'Atenas,GR':
                  header('Location: ../vista/atenas2.php#titulo');
                  //Cerramos buffer tras header:
                  ob_end_flush();
                  break;
                case 'Paris,FR':
                  header('Location: ../vista/paris2.php#titulo');
                  //Cerramos buffer tras header:
                  ob_end_flush();
                  break;
              }
          }else{
            //Si no se marca la segunda habitación, se utiliza el siguiente redireccionamiento:
            //Si el usuario ya está recordado por la cookie previa se verifica:
          if(isset($_COOKIE["datos"])){
            header('Location: control.php?rec=true');
            //Cerramos buffer tras header:
            ob_end_flush();
            //Si el usuario ya se ha logado anteriormente se redirige a su sesión hasta que se cierre el navegador:
          }elseif (isset($_SESSION["usuario"])) {
            header('Location: ../vista/sesion.php?user=ok');
            //Cerramos buffer tras header:
            ob_end_flush();
            //Se envía al login, Acceder.php:
          }else {
            header('Location: ../vista/acceder.php');
            //Cerramos buffer tras header:
            ob_end_flush();
          }
        }
      }
    break;
  }
}
 ?>
