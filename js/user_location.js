//Geolocation:
var user_location = document.getElementById("user_location");

function getUserLocation() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(showPosition);
    } else {
        user_location.innerHTML = "No geolocation support.";
    }
}

//Center and zoom in on user position
function showPosition(position) {
    user_location.innerHTML = "LAT: " + position.coords.latitude +
        " LON: " + position.coords.longitude;
    map.center({lat: position.coords.latitude, lon: position.coords.longitude});
    map.zoom(14);
}
