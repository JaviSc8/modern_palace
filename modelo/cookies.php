<?php
//Creamos una clase cookies para insertar y trasladar entre páginas los datos de la reserva de habitaciones:
class cookies
{
  //Atributos:
  private $fechaInicio = null;
  private $fechaFin = null;
  public $temporada = [];
  public $reserva = [];
  public $tipoHab ="";
  public $regimen ="";

  //Constructor:
  function __construct(){}
  //Método para crear la cookie con los datos de reserva por habitación:
  public function contenido(){
    //Determinar el tipo de habitacion y el regimen:
    switch ($_POST["regimen"]) {
      case "simpleDesayuno":
        $this->tipoHab = "simple";
        $this->regimen = "desayuno";
        break;
      case "simpleMedia":
        $this->tipoHab = "simple";
        $this->regimen = "media";
        break;
      case "dobleDesayuno":
        $this->tipoHab = "doble";
        $this->regimen = "desayuno";
        break;
      case "dobleMedia":
        $this->tipoHab = "doble";
        $this->regimen = "media";
        break;
      }
      //Bucle para contar las noches entre fechas y determinar temporada por meses (de Junio a Agosto temporada alta):
      $this->fechaInicio = strtotime($_POST["fecha_entrada"]);
      $this->fechaFin = strtotime($_POST["fecha_salida"]);
      for($i=$this->fechaInicio+86400; $i<=$this->fechaFin; $i+=86400){
        $mes = date("m", $i);
        if ($mes > 5 && $mes < 9) {
          array_push($this->temporada, "alta");
        }else {
            array_push($this->temporada, "baja");
            }
      }
      //Añadimos nuevos datos a la variable de la cookie:
      $this->reserva["Destino"] = $_POST["destino"];
      $this->reserva["Entrada"] = $_POST["fecha_entrada"];
      $this->reserva["Salida"] = $_POST["fecha_salida"];
      $this->reserva["Adultos"] = $_POST["adultos"];
      $this->reserva["Tipo"] = $this->tipoHab;
      $this->reserva["Regimen"] = $this->regimen;
    }
  //Método para incluir el precio total a la cookie:
  public function insertaPrecio(){
    $total=0;
    foreach ($this->temporada as $value) {
      if ($value == "alta") {
        $total+=$this->reserva["Precio_noche"];
        $this->reserva["Precio_total"] = $total +=20;
      } else {
        $total+=$this->reserva["Precio_noche"];
        $this->reserva["Precio_total"] = $total;
      }
    }
  }
  //Método para crear una cookie con los datos de la reserva:
  public function crear($nombreCookie){
    //Creamos la cookie con duración de una hora y posibilidad de uso en todo el dominio:
    setcookie($nombreCookie, json_encode($this->reserva), time()+60*60, "/");
  }
}
/*------------------------------------------------------------------------*/
//FUNCIONES para utilizar fuera de la clase:
//Decodificar la información de las cookies:
function usar($nombreCookie){
  return json_decode($_COOKIE[$nombreCookie], true);
}
//Recordar el id de sesión, usuario y contraseña en dos cookies que duren un mes:
function recordarUsuario(){
  $datosUsuario=[
    "ID" => session_id(),
    "Usuario" => $_SESSION["usuario"],
    "Pw" => $_SESSION["password"]
  ];
  setcookie("datos",json_encode($datosUsuario),time()+(60*60*24*30),"/");
}
//Borrar las cookies que ya han cumplido su cometido (reservas) estableciendola vacía y con el tiempo expìrado:
function eliminar($nombreCookie){
  setcookie($nombreCookie, "", time()-1,"/");
}
 ?>
