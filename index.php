
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
        <div><p id="userLocation"></p></div>
        <div><p id="mooseData"></p></div>

        <!-- Google Analytics: change UA-XXXXX-X to be your site's ID. -->
        <script>

            var anchLat = 61.1954;
            var anchLon = -149.4784;

            $(function() {
                getUserLocation();
                selectAll();
            })


            mapboxgl.accessToken = 'pk.eyJ1Ijoia3lsZWx1b21hIiwiYSI6ImNqZXN6YmkxaTAyaTgyd3FvZWh4eGMzNnQifQ.zuc_sYc32KMNfyi0NHitJA';
            var map = new mapboxgl.Map({
                container: 'map',
                center: [anchLon, anchLat],
                zoom: 6.0,
                style: 'mapbox://styles/mapbox/streets-v10'
            });

            // Draw GeoJSON file (TODO: Refactor into seperate)
            map.addlayer({
                "id": "points",
                "type": "symbol",
                "source": {
                    "type": "geojson",
                    "data": selectAll()
                }
            })

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
                user_location.innerHTML = "LAT: " + position.coords.latitude +
                    " LON: " + position.coords.longitude;
            }

        </script>
    </body>
</html>
