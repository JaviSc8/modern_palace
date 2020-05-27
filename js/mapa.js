//Asignación a variables del elemento ciudad y su valor:
var city = document.getElementById('ciudad');
var value = document.getElementById('ciudad').value;

//Función para asignar el mapa:
function mapa(){
  //Mediante switch seleccionamos el mapa correspondiente según el valor de la variable value:
  switch (value) {
    case "map":
        //Mapa para INDEX:
        var map = L.map('map').setView([41.89, 12.49], 4);
        L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoiamF2aXNjIiwiYSI6ImNrOW9nNTE3YjAwYjYzZW54cWF1aHEzOWcifQ.wfGylQGxBuQMOLlYcVD1KQ', {
        attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
        maxZoom: 18,
        id: 'mapbox/streets-v11',
        tileSize: 512,
        zoomOffset: -1,
        accessToken: 'your.mapbox.access.token'
        }).addTo(map);
        //Marcadores de posición del mapa:
        var marker1 = L.marker([36.72, -4.42]).addTo(map);
        var marker2 = L.marker([48.85, 2.34]).addTo(map);
        var marker3 = L.marker([41.89, 12.49]).addTo(map);
        var marker4 = L.marker([37.97, 23.72]).addTo(map);
        //Popup con el texto correspondiente por cada marcador:
        marker1.bindPopup('<b>Modern Palace Málaga</b>')
        marker2.bindPopup('<b>Modern Palace París</b>')
        marker3.bindPopup('<b>Modern Palace Roma</b>')
        marker4.bindPopup('<b>Modern Palace Atenas</b>')
    break;
   case "Malaga,ES":
        //Mapa de Málaga:
        var Malaga = L.map('Malaga').setView([36.7211, -4.4218], 13);
        L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoiamF2aXNjIiwiYSI6ImNrOW9nNTE3YjAwYjYzZW54cWF1aHEzOWcifQ.wfGylQGxBuQMOLlYcVD1KQ', {
        attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
        maxZoom: 18,
        id: 'mapbox/streets-v11',
        tileSize: 512,
        zoomOffset: -1,
        accessToken: 'your.mapbox.access.token'
        }).addTo(Malaga);
        //Marcador de posición del mapa:
        var marker = L.marker([36.72, -4.42]).addTo(Malaga);
        //Popup con el texto correspondiente:
        marker.bindPopup('<b>Modern Palace Málaga</b>')
    break;
  case "Paris,FR":
        //Mapa de París:
        var Paris = L.map('Paris').setView([48.85, 2.34], 13);
        L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoiamF2aXNjIiwiYSI6ImNrOW9nNTE3YjAwYjYzZW54cWF1aHEzOWcifQ.wfGylQGxBuQMOLlYcVD1KQ', {
        attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
        maxZoom: 18,
        id: 'mapbox/streets-v11',
        tileSize: 512,
        zoomOffset: -1,
        accessToken: 'your.mapbox.access.token'
        }).addTo(Paris);
        //Marcador de posición del mapa:
        var marker = L.marker([48.85, 2.34]).addTo(Paris);
        //Popup con el texto correspondiente:
        marker.bindPopup('<b>Modern Palace París</b>')
    break;
  case "Roma,IT":
        //Mapa de Roma:
        var Roma = L.map('Roma').setView([41.89, 12.49], 13);
        L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoiamF2aXNjIiwiYSI6ImNrOW9nNTE3YjAwYjYzZW54cWF1aHEzOWcifQ.wfGylQGxBuQMOLlYcVD1KQ', {
        attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
        maxZoom: 18,
        id: 'mapbox/streets-v11',
        tileSize: 512,
        zoomOffset: -1,
        accessToken: 'your.mapbox.access.token'
        }).addTo(Roma);
        //Marcador de posición del mapa:
        var marker = L.marker([41.89, 12.49]).addTo(Roma);
        //Popup con el texto correspondiente:
        marker.bindPopup('<b>Modern Palace Roma</b>')
    break;
  case "Atenas,GR":
        //Mapa de Atenas:
        var Atenas = L.map('Atenas').setView([37.97, 23.72], 13);
        L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoiamF2aXNjIiwiYSI6ImNrOW9nNTE3YjAwYjYzZW54cWF1aHEzOWcifQ.wfGylQGxBuQMOLlYcVD1KQ', {
        attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
        maxZoom: 18,
        id: 'mapbox/streets-v11',
        tileSize: 512,
        zoomOffset: -1,
        accessToken: 'your.mapbox.access.token'
        }).addTo(Atenas);
        //Marcador de posición del mapa:
        var marker = L.marker([37.97, 23.72]).addTo(Atenas);
        //Popup con el texto correspondiente:
        marker.bindPopup('<b>Modern Palace Atenas</b>')
    break;
    }
  }
//Se añade el evento DOMContentLoaded con la ejecución de la función "mapa" en el selector para seleccionar el mapa correspondiente:
  city.addEventListener("DOMContentLoaded", mapa(value));
