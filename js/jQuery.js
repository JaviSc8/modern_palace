//Si da fallo situar encima para asegurar la carga de los elementos:
//$(document).ready(function(){
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
    //Añadir clase (Zoom):
    $(".zoom").hover(function(){
  $(this).toggleClass("transition");
  });
   //Añadir clase (Zoom):
   //$("#prueba").hover(function(){
 //$(this).toggleClass("aumento");
//});
//Animación para zoom letra
estado=0;
$("#prueba").hover(function(){
 if (estado==0) {
    $(this).animate({"font-size":"120%","left":"450px"},1500);
    estado=1;
    }
 else {
    $(this).animate({"font-size":"100%","left":"20px"},1500);
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
