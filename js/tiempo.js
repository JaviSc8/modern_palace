//Asignación a variables del elemento ciudad y su valor:
var city = document.getElementById('ciudad');
var value = document.getElementById('ciudad').value;

//Creación de la solicitud asíncrona al API de open weather para obtener el tiempo en destinos.php:
var solicitud = new XMLHttpRequest();
solicitud.open('GET', 'https://api.openweathermap.org/data/2.5/weather?q='+value+
'&units=metric&APPID=24e2c0955115b147670c3164f10a974a', true);

//Función para visualizar el tiempo en el div si la solicitud se ejecuta correctamente, si no, mensaje de error:
function verTiempo(){
  if (solicitud.readyState == 4) {
    if(solicitud.status == 200){
      //Se parsea el JSON recibido y se comprueba por consola:
      var tiempo = JSON.parse(solicitud.responseText);
      console.log(tiempo);
      //Array con la respuesta a sacar por pantalla:
      var respuesta = [
      "Temperatura: "+tiempo['main']['temp']+" ºC. ", "Máx: "+tiempo['main']['temp_max']+" ºC. ",
      "Mín: "+tiempo['main']['temp_min']+" ºC. ", "Humedad: "+tiempo['main']['humidity']+" %. ",
      "Viento: "+tiempo['wind']['speed']+" m/s. ", "Nubes: "+tiempo['clouds']['all']+" %. "
    ];
    //Obtención del div "datos" y creación de una lista:
      var divDatos = document.getElementById("datos");
      var lista = document.createElement("ul");
      //Mediante for se recorre el array de la respuesta introduciendo cada elemento en la lista:
      for (var i = 0; i < respuesta.length; i++) {
        var elementoLista = document.createElement("li");
        var texto = document.createTextNode(respuesta[i]);
        elementoLista.appendChild(texto);
        lista.appendChild(elementoLista);
        divDatos.appendChild(lista);
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
/*Se añade el evento "DOMContentLoaded" con la ejecución de la función "verTiempo", para que cuando termine de cargar
el DOM cargue la información del tiempo:*/
  city.addEventListener("DOMContentLoaded", verTiempo(value));
