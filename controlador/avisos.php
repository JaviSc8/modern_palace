<?php
//INDEX.PHP: Fallo en disponibilidad reserva gracias a GET:
function falloReserva(){
 if(isset($_GET["reserva"]) && $_GET["reserva"] == 'ko'){
    echo '<script type="text/javascript">alert("Sin habitaciones disponibles para las fechas seleccionadas")</script>';
  };
}

//DESTINO.PHP: Fallo en disponibilidad reservas por tipo de habitación gracias a GET:
function falloHabitacion(){
 if(isset($_GET["simple"]) && $_GET["simple"] == 'ko'){
    echo '<script type="text/javascript">alert("Sin habitaciones simples disponibles para las fechas seleccionadas")</script>';
  };
  if(isset($_GET["doble"]) && $_GET["doble"] == 'ko'){
    echo '<script type="text/javascript">alert("Sin habitaciones dobles disponibles para las fechas seleccionadas")</script>';
   };
}

//REGISTRO.PHP: Se especifican los fallos de usuario y contraseña gracias a GET:
function falloRegistro(){
  if(isset($_GET["falloUsuario"]) && $_GET["falloUsuario"] == 'true'){
    echo '<script type="text/javascript">alert("Usuario no disponible, inserte otro nombre de usuario")</script>';
  };
  if(isset($_GET["falloPass"]) && $_GET["falloPass"] == 'true'){
    echo '<script type="text/javascript">alert("Las contraseñas no coinciden")</script>';
  };
}

//ACCEDER.PHP: Se especifican los fallos de usuario y contraseña, y el registro correcto en registro.php gracias a GET:
function avisoAcceder(){
 if(isset($_GET["falloUsuario"]) && $_GET["falloUsuario"] == 'true'){
    echo '<script type="text/javascript">alert("El usuario indicado no existe")</script>';
  };
 if(isset($_GET["falloPass"]) && $_GET["falloPass"] == 'true'){
    echo '<script type="text/javascript">alert("Contraseña incorrecta")</script>';
  };
  if(isset($_GET["registro"]) && $_GET["registro"] == 'ok'){
    echo '<script type="text/javascript">alert("Registro correcto, por favor inserte usuario y contraseña")</script>';
  };
}
//SESION.PHP: Se especifican los avisos para confirmación de reserva y actualización de datos gracias a GET:
function avisoSesion(){
  if(isset($_GET["res"]) && $_GET["res"] == 'ok'){
     echo '<script type="text/javascript">alert("Reserva confirmada")</script>';
  };
  if(isset($_GET["res"]) && $_GET["res"] == 'ko'){
    echo '<script type="text/javascript">alert("Sin reservas pendientes de confirmar")</script>';
  };
  if(isset($_GET["act"]) && $_GET["act"] == 'ok'){
     echo '<script type="text/javascript">alert("Datos actualizados")</script>';
  };
  if(isset($_GET["actPass"]) && $_GET["actPass"] == 'ok'){
    echo '<script type="text/javascript">alert("Contraseña actualizada")</script>';
  };
  if(isset($_GET["actPass"]) && $_GET["actPass"] == 'ko'){
      echo '<script type="text/javascript">alert("La contraseña actual no es correcta")</script>';
  };
}
?>
