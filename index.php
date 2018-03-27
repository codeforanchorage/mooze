
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
        //<script src="js/user_location.js"></script>
        <script src='https://api.mapbox.com/mapbox-gl-js/v0.44.1/mapbox-gl.js'></script>
        <link href='https://api.mapbox.com/mapbox-gl-js/v0.44.1/mapbox-gl.css' rel='stylesheet' />

        <p>Mooze wildlife spotting app</p>
        <div id="coordinate"></div>
        <div class="mapContainer" >
            <div id='map' style='width: 400px; height: 300px;'></div>
        </div>
        <div><p id="userLocation"></p></div>
        <div><p id="mooseData"></p></div>

        <button type="button" id="insertTest">Insertion Test</button>

        <!-- Google Analytics: change UA-XXXXX-X to be your site's ID. -->
        <script>
            //Variables:
            var anchLat = 61.1954;
            var anchLon = -149.4784;
            var userLat = 0;
            var userLon = 0;

            //Initialize the map
            mapboxgl.accessToken = 'pk.eyJ1Ijoia3lsZWx1b21hIiwiYSI6ImNqZXN6YmkxaTAyaTgyd3FvZWh4eGMzNnQifQ.zuc_sYc32KMNfyi0NHitJA';
            var map = new mapboxgl.Map({
                container: 'map',
                center: [anchLon, anchLat],
                zoom: 6.0,
                style: 'mapbox://styles/mapbox/streets-v10'
            });

            //Execute these functions when document is loaded (ready)
            $(function() {
                getUserLocation();
                drawSightingMarkers();
                initializeListeners()
            })

            //Initialize object listeners on the page:
            function initializeListeners() {
                document.getElementById('insertTest')
                    .addEventListener("click", function () {
                            //Convert ISO string to MySql datetime format:
                            //TODO: Refactor to seperate function. This will be called routinely.
                            var datetime = new Date().toISOString().slice(0, 19).replace('T', ' ');

                            if (userLat != 0 && userLon != 0) {
                                insertSighting(datetime, userLat, userLon, 1, 0);
                            }
                        }
                    );
            }

            //Draw markers to the map
            function drawSightingMarkers() {
                addAllMarkers();
            }

            //TEST Marker draw:
            var userMarker = new mapboxgl.Marker()
                .setLngLat([anchLon, anchLat])
                .addTo(map);

            //Geolocation:
            //TODO: refactor this into its own function that returns user location data.
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
                user_location.innerHTML = "LAT: " + userLat +
                    " LON: " + userLon;
            }

        </script>
    </body>
</html>
