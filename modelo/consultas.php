<?php
  include "db.php";

  class consultas extends db
  {
    //Llamamos al constructor de la clase padre para establecer conexión:
    function __construct()
    {
      parent::__construct();
    }

    //Función para consultar un usuario de la tabla usuarios:
    public function consulta($usuario){
      $tuConsulta = "SELECT * FROM usuarios WHERE usuario = '".$usuario."'";
      return $this->consultar($tuConsulta);
    }
    //Función para insertar entradas en la tabla usuarios:
  public function insertar($usuario, $nombre, $apellidos, $password, $email){
      $insertar="INSERT INTO usuarios (usuario, nombre, apellidos, password, email) VALUES ('".$usuario."',
      '".$nombre."', '".$apellidos."','".$password."', '".$email."')";
      return $this->consultar($insertar);
  }
    //Función para actualizar entradas de la tabla usuarios:
  public function actualizar($usuario, $nombre, $apellidos, $email){
      $update="UPDATE usuarios SET nombre = '".$nombre."', apellidos = '".$apellidos."', email = '".$email."' WHERE usuario='".$usuario."'";
      return $this->consultar($update);
  }
  //Función para consultar el precio de las opciones elegidas:
  public function precio($destino, $tipo, $regimen){
    $precio = "SELECT precio FROM habitacion, destinos WHERE destinos.IdDestino = habitacion.IdDestino
    AND nombre = '".$destino."' AND Tipo = '".$tipo."' AND Regimen = '".$regimen."'";
    return $this->consultar($precio);
  }
  //Función para obtener el id de la habitacion de la reserva:
  public function idHabitacion($destino, $tipo, $regimen){
    $idHab = "SELECT IdHabitacion FROM habitacion, destinos WHERE destinos.IdDestino = habitacion.IdDestino
    AND nombre = '".$destino."' AND Tipo = '".$tipo."' AND Regimen = '".$regimen."'";
    return $this->consultar($idHab);
  }
  //Función para insertar los datos de reserva:
  public function reserva($usuario, $idHabitacion, $fechaEntrada, $fechaSalida, $numAdultos, $precioDef){
    $reserva = "INSERT INTO reservas (IdReserva, usuario, IdHabitacion, fecha_entrada, fecha_salida, num_adultos, precioDef)
    VALUES (NULL, '".$usuario."', '".$idHabitacion."', '".$fechaEntrada."', '".$fechaSalida."', '".$numAdultos."', '".$precioDef."')";
    return $this->consultar($reserva);
  }
  //Función para consultar los datos de reserva:
  public function miReserva($usuario){
    $mireserva = "SELECT IdReserva, destinos.nombre, habitacion.Tipo, habitacion.Regimen, reservas.fecha_entrada, reservas.fecha_salida, reservas.num_adultos
    FROM destinos, habitacion, reservas WHERE destinos.IdDestino = habitacion.IdDestino AND habitacion.IdHabitacion = reservas.IdHabitacion
    AND reservas.usuario = '".$usuario."'";
    return $this->consultar($mireserva);
  }
 }
 ?>
