//Si da fallo situar encima para asegurar la carga de los elementos:
//$(document).ready(function(){
//FECHAS. Poner como mínimo el valor de la fecha de entrada en fecha de salida haciendo uso del evento change del input:
$("#date1").change(function() {
  var fecha = document.getElementById('date1').value;
  var fechaDate = new Date(fecha);
  //Sumamos 1 al dia de la fecha paa que no permita escoger el mismo día seleccionado:
  fechaDate.setDate(fechaDate.getDate()+1);
  //Formateamos a YYYY-MM-DD teniendo cuidado al incluir 0 delante de los días y meses que lo requieran:
  dia = String(fechaDate.getDate());
  mes = String(fechaDate.getMonth()+1);
  anyo = fechaDate.getFullYear();
  if (mes.length < 2){
    mes = '0' + mes;
  }
  if (dia.length < 2){
      dia = '0' + dia;
    }
    //Incluimos al atributo min de fecha salida:
  $("#date2").attr({"min":anyo +"-"+mes+"-"+dia});
});
//----------------------------------------------------------------------
//Nº Adultos:
//Si se selecciona elementos tipo radio de habitación simple se incluye 1 adulto por habitación y no se permite utilizar el resto de opciones:
$(".simple").change(function() {
  $("#adultos").val('1');
  $(".option").attr("disabled", true);
});
//Si se selecciona elementos tipo radio de habitación doble se permite utilizar el resto de opciones:
$(".doble").change(function() {
  $(".option").attr("disabled", false);
});
//----------------------------------------------------------------------
//SESION.php: Petición AJAX asincrona para apartado Mis Reservas (Consultarlas):
$("#IDreserva").change(function() {
  var ID = $("#IDreserva").val();
  $.ajax(
  {
  async: true,
  url : '../controlador/control.php',
  type: "POST",
  data : {IDreserva:ID}
  })
  .done(function(data) {
    $("#respuesta").html(data);
  })
  .fail(function(data) {
    alert( "Error al obtener la reserva, intentelo en unos minutos" );
  })
});
//----------------------------------------------------------------------
//SESION.php: Petición AJAX asincrona para apartado Mis Reservas (eliminar reservas):
$("#eliminaReserva").click(function() {
  var option = confirm("Va a cancelar su reserva, ¿esta de acuerdo?");
  if (option == true){
  var ID = $("#IDreserva").val();
  $.ajax(
  {
  async: true,
  url : '../controlador/control.php',
  type: "POST",
  data : {IDreservaDel:ID}
  })
  .done(function(data) {
    alert("Reserva cancelada");
    //$('.nav-tabs a[href="#misreservas"]').tab('show');
})
  .fail(function(data) {
    alert( "Error al eliminar la reserva, intentelo en unos minutos");
  })
}
});
//----------------------------------------------------------------------
//SESION.PHP: Mensaje de actualización de datos:
$("#actualizaDatos").click(function() {
  alert("Datos actualizados");
});
//-----------------------------------------------------------------------
//EFECTOS: Scroll barra navegación:
/*$(window).scroll(function(){
  if( $(this).scrollTop() > 0 ){
    $('#nav').addClass('navEf');
    /*$('#nav').animate({"height":"9%"},1000);*/
  /*} else {
    $('#nav').removeClass('navEf');
  }
});*/
//Situar el raton:
$( "#caja" ).hover(function() {
  $("#caja").css("background-color", "#000000");
  }, function(){
    $("#caja").css("background-color", "#C3C3C3");
  });
  //Desaparecer con boton:
    $( "#caja" ).click(function() {
      $( "#caja" ).slideToggle( "slow" );
    });
    //Desaparecer sin botón:
    function desaparecer(){
      $( "#caja" ).slideToggle( "slow" );
    };
    //Añadir clase (Zoom iconos):
    $(".zoom").hover(function(){
  $(this).toggleClass("transition");
  });
//Animación para zoom letra
estado=0;
$("#prueba").hover(function(){
 if (estado==0) {
    $(this).animate({"font-size":"120%","left":"450px"},1000);
    estado=1;
    }
 else {
    $(this).animate({"font-size":"100%","left":"20px"},1000);
    estado=0;
    }
 });
 //Animación para zoom icono
 estado=0;
 $("#icono").hover(function(){
  if (estado==0) {
     $(this).animate({heigth:"120%", left:"+=50"},1500);
     estado=1;
     }
  else {
     $(this).animate({heigth:"100%", left:"-=50"},1500);
     estado=0;
     }
  });
