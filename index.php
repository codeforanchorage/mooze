
<!doctype html>
<html class="no-js" lang="">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>Mooze Wildlife Spotting</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="apple-touch-icon" href="apple-touch-icon.png">
        <!-- Place favicon.ico in the root directory -->

        <link rel="stylesheet" href="css/normalize.css">
        <link rel="stylesheet" href="css/main.css">
        <link rel="stylesheet" href="css/map_page.css">
        <script src="js/vendor/modernizr-2.8.3.min.js"></script>
    </head>
    <body>
        <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->

        <script src="https://code.jquery.com/jquery-1.12.0.min.js"></script>
        <script>window.jQuery || document.write('<script src="js/vendor/jquery-1.12.0.min.js"><\/script>')</script>
        <script src="js/plugins.js"></script>
        <script src="js/main.js"></script>
        <script src="js/ajax.js"></script>
        <script src="js/user_location.js"></script>
        <script src='https://api.mapbox.com/mapbox-gl-js/v0.44.1/mapbox-gl.js'></script>
        <link href='https://api.mapbox.com/mapbox-gl-js/v0.44.1/mapbox-gl.css' rel='stylesheet' />

        <p>Mooze wildlife spotting app</p>
        <div id="coordinate"></div>
        <div class="mapContainer" >
            <div id='map' style='width: 400px; height: 300px;'></div>
        </div>
        <table>
            <tr>
                <td><input type="range" id="timeframeSelection" max="14400" min="1"></td>
                <td>Timeframe Selection:</td>
                <td id="timeframeValue"></td>
            </tr>
            <tr>
                <td>Moose</td>
                <td>Bear</td>
            </tr>
            <tr>
                <td id="mooseCount" class="animalCounter">0</td>
                <td id="bearCount" class="animalCounter">0</td>
            </tr>
            <tr>
                <td id="mooseCountInc">UP</td>
                <td id="bearCountInc">UP</td>
            </tr>
            <tr>
                <td id="mooseCountDec">DN</td>
                <td id="bearCountDec">DN</td>
            </tr>
        </table>

        <div><p id="userLocation"></p></div>
        <div><p id="mooseData"></p></div>

        <button type="button" id="insertTest">Insertion Test</button>

        <!-- Google Analytics: change UA-XXXXX-X to be your site's ID. -->
        <script>
            //Constants
            const MAX_MOOSE = 10;
            const MAX_BEAR = 4;

            //Variables:
            var anchLat = 61.1954;
            var anchLon = -149.4784;
            var userLat = 0;
            var userLon = 0;
            var userCoords = [userLon, userLat];
            var anchCoords = [anchLon, anchLat];
            var mooseCount = 0;
            var bearCount = 0;

            //Initialize the map
            mapboxgl.accessToken = 'pk.eyJ1Ijoia3lsZWx1b21hIiwiYSI6ImNqZXN6YmkxaTAyaTgyd3FvZWh4eGMzNnQifQ.zuc_sYc32KMNfyi0NHitJA';
            var map = new mapboxgl.Map({
                container: 'map',
                center: anchCoords,
                zoom: 6.0,
                style: 'mapbox://styles/mapbox/streets-v10'
            });

            //Execute these functions after document is loaded (ready)
            $(function() {
                getUserLocation();
                loadMapImages();
                drawSightingMarkers();
                initializeListeners();
            })

            //Initialize object listeners on the page:
            function initializeListeners() {

                //Increase moose counter button
                document.getElementById('mooseCountInc').addEventListener("click", function() {
                    if(mooseCount < MAX_MOOSE) {
                        mooseCount += 1;
                        document.getElementById('mooseCount').innerHTML = mooseCount;
                    }
                })

                document.getElementById('mooseCountDec').addEventListener("click", function() {
                    if(mooseCount > 0) {
                        mooseCount -= 1;
                        document.getElementById('mooseCount').innerHTML = mooseCount;
                    }
                })

                document.getElementById('bearCountInc').addEventListener("click", function() {
                    if(bearCount < MAX_BEAR) {
                        bearCount += 1;
                        document.getElementById('bearCount').innerHTML = bearCount;
                    }
                })

                document.getElementById('bearCountDec').addEventListener("click", function() {
                    if(bearCount > 0) {
                        bearCount -= 1;
                        document.getElementById('bearCount').innerHTML = bearCount;
                    }
                })

                //Insert sighting test button
                document.getElementById('insertTest').addEventListener("click", function () {
                    //Convert ISO string to MySql datetime format:
                    //TODO: Refactor to seperate function. This will be called routinely.

                    var datetime = new Date().toISOString().slice(0, 19).replace('T', ' ');

                    if (userLat != 0 && userLon != 0) {
                        insertSighting(datetime, userCoords[1], userCoords[0], mooseCount, bearCount);
                    }
                });

                //Timeframe selection slider:
                var TFSel = document.getElementById('timeframeSelection');
                TFSel.addEventListener("change", function() {
                    var days = 0;
                    var hours = 0;
                    var minutes = TFSel.value;
                    //Present minutes in Day / Hour / Minute string:
                    if (minutes >= 60) {
                        hours = Math.floor(minutes / 60);
                        minutes = minutes - (hours * 60);
                    }
                    if (hours >= 24) {
                        days = Math.floor(hours / 24);
                        hours = hours - (days * 24);
                    }
                    var timeString = "" + days + " Days, "
                        + hours + " Hours, " + minutes + " Minutes.";
                    document.getElementById('timeframeValue').innerHTML = timeString;
                })
            }

            //Draw markers to the map
            function drawSightingMarkers() {
                getAllSightings();
            }

            //Load map icon images and add them to map object
            function loadMapImages() {
                //TODO: load images for icons
                map.loadImage('img/flower-small.jpg', function(error, image) {
                    //REF: https://www.mapbox.com/mapbox-gl-js/example/add-image/
                    if(error) {
                        throw error;
                    }
                    map.addImage('flower', image);
                });
                map.loadImage('img/moose_1.png', function(error, image) {
                    //REF: https://www.mapbox.com/mapbox-gl-js/example/add-image/
                    if(error) {
                        throw error;
                    }
                    map.addImage('moose_1', image);
                });

                map.loadImage('img/bear_1.png', function(error, image) {
                    //REF: https://www.mapbox.com/mapbox-gl-js/example/add-image/
                    if(error) {
                        throw error;
                    }
                    map.addImage('bear_1', image);
                });

                map.loadImage('img/both.png', function(error, image) {
                    //REF: https://www.mapbox.com/mapbox-gl-js/example/add-image/
                    if(error) {
                        throw error;
                    }
                    map.addImage('both', image);
                });
            }

            //Geolocation:
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
                // This is a workaround solution:
                // Assign coordinate values to global DOM variables:
                // getUserLocation is asynchronous and cannot return
                // values to other functions when invoked.
                userLat = position.coords.latitude;
                userLon = position.coords.longitude;
                userCoords = [userLon, userLat];
                user_location.innerHTML = "LAT: " + userLat +
                    " LON: " + userLon;
            }
        </script>
    </body>
</html>
