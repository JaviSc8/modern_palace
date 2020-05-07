<?php
//INDEX.PHP: Fallo en disponibilidad reserva gracias a GET:
function falloReserva(){
 if(isset($_GET["reserva"]) && $_GET["reserva"] == 'ko'){
    echo "<div style='color:red'>Sin habitaciones disponibles para las fechas seleccionadas</div>";
  };
}
//DESTINO.PHP: Fallo en disponibilidad reservas gracias a GET:
function falloHabitacion(){
 if(isset($_GET["simple"]) && $_GET["simple"] == 'ko'){
    echo "<div style='color:red'>Sin habitaciones simples disponibles para las fechas seleccionadas</div>";
  };
  if(isset($_GET["doble"]) && $_GET["doble"] == 'ko'){
     echo "<div style='color:red'>Sin habitaciones dobles disponibles para las fechas seleccionadas</div>";
   };
}
//REGISTRO.PHP: Se especifican los fallos de usuario y contraseña gracias a GET:
function falloRegistro(){
  if(isset($_GET["falloUsuario"]) && $_GET["falloUsuario"] == 'true'){
    echo "<div style='color:red'>Usuario no disponible, inserte otro nombre de usuario</div>";
  };
  if(isset($_GET["falloPass"]) && $_GET["falloPass"] == 'true'){
    echo "<div style='color:red'>Las contraseñas no coinciden</div>";
  };
}
//ACCEDER.PHP: Se especifican los fallos de usuario y contraseña gracias a GET:
function falloAcceder(){
 if(isset($_GET["falloUsuario"]) && $_GET["falloUsuario"] == 'true'){
    echo "<div style='color:red'>El usuario indicado no existe</div>";
  };
 if(isset($_GET["falloPass"]) && $_GET["falloPass"] == 'true'){
    echo "<div style='color:red'>Contraseña incorrecta</div>";
  };
}
