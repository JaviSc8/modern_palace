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
  public function insertar($usuario, $nombre, $apellidos, $password, $email, $telefono, $publicidad){
      $insertar="INSERT INTO usuarios (usuario, nombre, apellidos, password, email, telefono, publicidad) VALUES ('".$usuario."',
      '".$nombre."', '".$apellidos."','".$password."', '".$email."', '".$telefono."', '".$publicidad."')";
      return $this->consultar($insertar);
  }
    //Función para actualizar entradas de la tabla usuarios:
  public function actualizar($usuario, $nombre, $apellidos, $email, $telefono, $publicidad){
      $update="UPDATE usuarios SET nombre = '".$nombre."', apellidos = '".$apellidos."', email = '".$email."', telefono = '".$telefono."',
      publicidad = '".$publicidad."'  WHERE usuario='".$usuario."'";
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
  //Función para consultar los datos de reserva por usuario:
  public function miReserva($usuario){
    $mireserva = "SELECT IdReserva, destinos.nombre, habitacion.Tipo, habitacion.Regimen, reservas.fecha_entrada, reservas.fecha_salida, reservas.num_adultos, reservas.PrecioDef
    FROM destinos, habitacion, reservas WHERE destinos.IdDestino = habitacion.IdDestino AND habitacion.IdHabitacion = reservas.IdHabitacion
    AND reservas.usuario = '".$usuario."'";
    return $this->consultar($mireserva);
  }
  //Función para consultar el ID de reserva:
  public function IDReserva($usuario){
    $IDreserva = "SELECT IdReserva
    FROM reservas WHERE reservas.usuario = '".$usuario."'";
    return $this->consultar($IDreserva);
  }
  //Función para consultar los datos de reserva por ID:
  public function miReservaID($IdReserva){
    $mireservaID = "SELECT destinos.nombre, habitacion.Tipo, habitacion.Regimen, reservas.fecha_entrada, reservas.fecha_salida, reservas.num_adultos, reservas.PrecioDef
    FROM destinos, habitacion, reservas WHERE destinos.IdDestino = habitacion.IdDestino AND habitacion.IdHabitacion = reservas.IdHabitacion
    AND reservas.IdReserva = '".$IdReserva."'";
    return $this->consultar($mireservaID);
  }
  //Función para eliminar los datos de reserva por ID:
  public function delReserva($idReserva){
    $delReserva = "DELETE FROM reservas WHERE reservas.IdReserva = '".$idReserva."'";
    return $this->consultar($delReserva);
  }
  //Función para consultar disponibilidad de fechas:
  public function disponibilidad($fechaInicio, $fechaFin){
    $disponibReserva = "SELECT IdReserva, reservas.IdHabitacion, Tipo FROM reservas INNER JOIN habitacion ON reservas.IdHabitacion = habitacion.IdHabitacion WHERE
    (fecha_entrada BETWEEN '".$fechaInicio."' AND '".$fechaFin."') OR (fecha_salida BETWEEN '".$fechaInicio."' AND '".$fechaFin."') OR (fecha_entrada <= '".$fechaInicio."' AND fecha_salida >= '".$fechaFin."')";
    return $this->consultar($disponibReserva);
 }
  //Función para consultar disponibilidad de fechas en hab. simple:
   public function disponibilidadSimple($fechaInicio, $fechaFin){
     $disponibReserva = "SELECT IdReserva, reservas.IdHabitacion, Tipo FROM reservas INNER JOIN habitacion ON reservas.IdHabitacion = habitacion.IdHabitacion WHERE
     ((fecha_entrada BETWEEN '".$fechaInicio."' AND '".$fechaFin."') OR (fecha_salida BETWEEN '".$fechaInicio."' AND '".$fechaFin."') OR (fecha_entrada <= '".$fechaInicio."' AND fecha_salida >= '".$fechaFin."'))AND tipo = 'simple'";
     return $this->consultar($disponibReserva);
  }
  //Función para consultar disponibilidad de fechas en hab doble:
  public function disponibilidadDoble($fechaInicio, $fechaFin){
    $disponibReserva = "SELECT IdReserva, reservas.IdHabitacion, Tipo FROM reservas INNER JOIN habitacion ON reservas.IdHabitacion = habitacion.IdHabitacion WHERE
    ((fecha_entrada BETWEEN '".$fechaInicio."' AND '".$fechaFin."') OR (fecha_salida BETWEEN '".$fechaInicio."' AND '".$fechaFin."') OR (fecha_entrada <= '".$fechaInicio."' AND fecha_salida >= '".$fechaFin."')) AND tipo = 'doble'";
    return $this->consultar($disponibReserva);
  }
}
 ?>
