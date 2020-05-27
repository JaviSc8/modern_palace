//------------------------------------------------------------------------------
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
//------------------------------------------------------------------------------
//Nº ADULTOS:
//Si se seleccionan elementos tipo radio de habitación simple, se incluye 1 adulto por habitación y no se permite utilizar el resto de opciones:
$(".simple").change(function() {
  $("#adultos").val('1');
  $(".option").attr("disabled", true);
});
//Si se seleccionan elementos tipo radio de habitación doble, se permite utilizar el resto de opciones:
$(".doble").change(function() {
  $(".option").attr("disabled", false);
});
//------------------------------------------------------------------------------
//SESION.php: Petición AJAX asincrona para apartado Mis Reservas (Mostrarlas):
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
//------------------------------------------------------------------------------
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
})
  .fail(function(data) {
    alert( "Error al eliminar la reserva, intentelo en unos minutos");
  })
}
});
//------------------------------------------------------------------------------
//EFECTOS:
//Subir al inicio de la página recorriendola pulsando el logo del pie utilizando animate:
$("#logopie").on("click", function(e){
    e.preventDefault();
    $("html, body").animate({
        scrollTop: 0
    }, 1000);
});

//Ocultar y mostrar información del hotel/destino mediante fadeIn al hacer scroll hacia abajo:
$(".info").hide();
$(window).scroll(function() {
    if ($(document).scrollTop() > 360) {
      $(".info").fadeIn(2000);
    }
  });

//Añadir clase transition (Zoom iconos redes sociales):
$(".zoom").hover(function(){
  $(this).toggleClass("transition");
  });
