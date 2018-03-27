/**
 * Selects all sighting tuples from database
 * adds all coordinates as markers to map.
 */
function addAllMarkers() {
    var mooseData = document.getElementById("mooseData");
    $.ajax({
        url: 'https://kyleluoma.com/mooze/php/CRUD/selectAll.php',
        type: 'post',
        data: {},
        dataType: 'json',
        cache: false,
        success: function(json) {
            //mooseData.innerHTML = JSON.stringify(json);
            var sightings = JSON.stringify(json);
            mooseData.innerHTML = json.length;
            for (var i = 0; i < json.length; i++) {
                var tempMarker = new mapboxgl.Marker();
                tempMarker.setLngLat([json[i].longitude, json[i].latitude]);
                tempMarker.addTo(map);
            }
        },
        error: function() {
            //TODO: add error handling;
        }
    });
}

function insertSighting(dateTime, currentLat, currentLon, mooseQty, bearQty) {
    $.ajax({
        url: 'https://kyleluoma.com/mooze/php/CRUD/insertSighting.php',
        type: 'post',
        data: {datetime : dateTime, latitude : currentLat, longitude : currentLon, mooseqty : mooseQty, bearqty : bearQty},
        cache: false,
        success: function() {
            //STUB
        },
        error: function() {
            //STUB
        }
    })
}