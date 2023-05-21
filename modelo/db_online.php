<?php
class db
{
  //Atributos de conexión:
  private $host = "sql107.epizy.com";
  private $usuario = "epiz_34253107";
  private $password = "T8Qzr7PuXfIW0";
  private $bd = "epiz_34253107_hotelespalace";
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
