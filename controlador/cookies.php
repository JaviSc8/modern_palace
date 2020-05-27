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
    //Determinar el tipo de habitacion y el regimen mediante switch:
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
      //Recorrer las noches entre fechas y determinar temporada por meses (de Junio a Agosto temporada alta):
      //Pasamos las fechas a tiempo standard:
      $this->fechaInicio = strtotime($_POST["fecha_entrada"]);
      $this->fechaFin = strtotime($_POST["fecha_salida"]);
      /*Utilizamos for para recorrer las noches entre la fecha de entrada y salida sumando un día a la fecha de inicio (86400 segundos),
      para recorrer el número de noches exacto. Incluimos al array temporada, "alta" si recorre una noche en temporada alta, o "baja" si se recorre
      una noche en temporada baja*/
      for($i=$this->fechaInicio+86400; $i<=$this->fechaFin; $i+=86400){
        $mes = date("m", $i);
        if ($mes > 5 && $mes < 9) {
          array_push($this->temporada, "alta");
        }else {
            array_push($this->temporada, "baja");
            }
      }
      //Añadimos nuevos datos al array reserva de la cookie:
      $this->reserva["Destino"] = $_POST["destino"];
      $this->reserva["Entrada"] = $_POST["fecha_entrada"];
      $this->reserva["Salida"] = $_POST["fecha_salida"];
      $this->reserva["Adultos"] = $_POST["adultos"];
      $this->reserva["Tipo"] = $this->tipoHab;
      $this->reserva["Regimen"] = $this->regimen;
    }

  //Función para incluir el precio total a la cookie:
  public function insertaPrecio(){
    $total=0;
    /*Mediante foreach se recorre el array temporada, donde con cada iteración se suman los valores del precio tarificado (obtenido de la base de datos),
    y obteniendo y asignando por tanto el precio total. Además, por cada valor "alta" encontrado se suman 20 euros al valor del precio por noche tarificado*/
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
  //Función para crear una cookie con los datos de la reserva:
  public function crear($nombreCookie){
    //Creamos la cookie mediante JSON con duración de un día y posibilidad de uso en todo el dominio:
    setcookie($nombreCookie, json_encode($this->reserva), time()+60*60*24, "/");
  }
}
/*------------------------------------------------------------------------*/
//FUNCIONES PARA UTILIZAR FUERA DE CLASE:
//Decodificar la información de las cookies:
function usar($nombreCookie){
  return json_decode($_COOKIE[$nombreCookie], true);
}

//Recordar el id de sesión, usuario y contraseña en una cookie que dure un mes, para la utilidad de recordar usuario (acceder.php):
function recordarUsuario(){
  $datosUsuario=[
    "ID" => session_id(),
    "Usuario" => $_SESSION["usuario"],
    "Pw" => $_SESSION["password"]
  ];
  setcookie("datos",json_encode($datosUsuario),time()+(60*60*24*30),"/");
}

//Borrar las cookies que ya han cumplido su cometido (reservas), estableciendolas vacías y con el tiempo expìrado:
function eliminar($nombreCookie){
  setcookie($nombreCookie, "", time()-1,"/");
}
 ?>
