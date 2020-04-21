//Asignación a variables del select y su valor:
var city = document.getElementById('ciudad');
var value = document.getElementById('ciudad').value;
//Creación de la solicitud:
var solicitud = new XMLHttpRequest();
solicitud.open('GET', 'http://api.openweathermap.org/data/2.5/weather?q='+value+
'&units=metric&APPID=24e2c0955115b147670c3164f10a974a', true);
//Función para visualizar el tiempo en el div si la solicitud se ejecuta correctamente, si no, mensaje de error:
function verTiempo(){
  if (solicitud.readyState == 4) {
    if(solicitud.status == 200){
      //Se parsea el JSON recibido y se comprueba por consola:
      var tiempo = JSON.parse(solicitud.responseText);
      console.log(tiempo);
      //Array con la respuesta a sacar por pantalla:
      var respuesta = [value+": ", tiempo['main']['temp']+" ºC. ",
    "Humedad: "+tiempo['main']['humidity']+" %. ", "Viento: "+tiempo['wind']['speed']+" m/s. ",
    "Nubes: "+tiempo['clouds']['all']+" %. ", "Máx: "+tiempo['main']['temp_max']+" ºC. ",
    "Mín: "+tiempo['main']['temp_min']+" ºC. "];
    //Obtención del div "datos" y cración de un parrafo:
      var divDatos = document.getElementById("datos");
      var parrafo = document.createElement("p");
      //Mediante for se recorre el array de la respuesta introduciendo cada elemento en el parrafo:
      for (var i = 0; i < respuesta.length; i++) {
        var texto = document.createTextNode(respuesta[i]);
        parrafo.appendChild(texto);
        divDatos.appendChild(parrafo);
      }
    }else{
    //Mensaje de error:
     alert("Petición errónea");
   }
  }
}
//Se lanza la función con el cambio de estado y se lanza la petición con valor null:
  solicitud.onreadystatechange = verTiempo;
  solicitud.send(null);
//Se añade el evento "cambio" con la ejecución de la función "verTiempo" en el selector:
  city.addEventListener("DOMContentLoaded", verTiempo(value));
