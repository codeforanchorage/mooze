var user_location = document.getElementById("userLocation");

function getUserLocation() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(showPosition);
    } else {
        user_location.innerHTML = "No geolocation support.";
    }
}

//Center and zoom in on user position
function showPosition(position) {
    userLat = position.coords.latitude;
    userLon = position.coords.longitude;
    document.getElementById("userLocation").innerHTML = "LAT: " + userLat +
        " LON: " + userLon;
}