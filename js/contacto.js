// Esta es la llave es unica y la creas dentro de google Developers
const API_KEY_MAPAS = "AIzaSyAitlgeijugEppv41GrDe7kjc0givjzHaY";
let map;
let objetoInfoWindow;

//Creacion del script y llamado:
var script = document.createElement('script');
script.src = `https://maps.googleapis.com/maps/api/js?key=${API_KEY_MAPAS}&callback=initMap`;
script.async = true;

// Adjuntar la llamada al mapa para su uso:
window.initMap = function () {
    map = new google.maps.Map(document.getElementById("divMapaGoogle"), {
        center: { lat: 19.4040675, lng: -98.9865747 },
        zoom: 15,
    });
    objetoInfoWindow = new google.maps.InfoWindow();
    const botonLocalizacion = document.createElement("button");
    botonLocalizacion.textContent = "Moverse a tu Localizacion";
    botonLocalizacion.classList.add("boton-mapa");
    map.controls[google.maps.ControlPosition.TOP_CENTER].push(botonLocalizacion);
    botonLocalizacion.addEventListener("click", () => {
        // Intentar La Geolocalizacion:
        if(navigator.geolocation) {
            //si:
            navigator.geolocation.getCurrentPosition(
                (position) => {
                    const posicion = {
                        lat: position.coords.latitude,
                        lng: position.coords.longitude
                    };
                    objetoInfoWindow.setPosition(posicion);
                    objetoInfoWindow.setContent( '<div class="text-success"> Aqui estas </div>');
                    objetoInfoWindow.open(map);
                    map.setCenter(position);
                },
                () => {
                    mostrarError(true, objetoInfoWindow, map.getCenter());
                }
            );
        } else {
            // No:
            mostrarError(false, objetoInfoWindow, map.getCenter());
        }
    });
};

function mostrarError(tieneGeolocalizacion, infoWindow, position) {
    infoWindow.setPosition(position);
    infoWindow.setContent (
        tieneGeolocalizacion
        ? "Atención: El servicio de geolocalizacion fallo."
        : "Atención: Tu navegador no soporta geolocalizacion."
    );
    infoWindow.open(map);
}

// Agregar el script a la cabecera:
document.head.appendChild(script);