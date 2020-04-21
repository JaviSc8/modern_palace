<?php
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
