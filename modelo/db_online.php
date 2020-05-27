<?php
class db
{
  //Atributos de conexión:
  private $host = "localhost";
  private $usuario = "id13600821_javier";
  private $password = "Rivera.11.1988";
  private $bd = "id13600821_hotelespalace";
  private $puerto = 3306;
  protected $conexion;
  //Atributos de error:
  protected $error = false;
  protected $msjError = "Ha habido algún problema";
  //Constructor:
  function __construct()
  {
    //Establecemos conexión con el objeto mysqli:
    $this->conexion = new mysqli($this->host, $this->usuario, $this->password, $this->bd, $this->puerto);
    //Control de errores de conexión:
    if ($this->conexion->connect_errno) {
      $this->error = true;
      echo $this->msjError;
    }
  }
    //Función para consultas genérica si no existe error:
  public function consultar($tuConsulta){
    if ($this->error == false){
      $consulta = $this->conexion->query($tuConsulta);
      return $consulta;
    }else{
      echo $this->msjError;
      return null;
    }
  }
}
