<?php
require "php/dbconnect.php";
global $dbcon;
$sql = "SELECT * FROM mooze.sighting";
$statement = $dbCon->prepare($sql);
$statement->execute();
$sighting = $statement->fetchall();

?>


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


        <p>Mooze wildlife spotting app</p>
        <div id="coordinate"></div>
        <div class="map" >
            <svg id="map" width="500px" height="500px">
            </svg>
            <p id="user_location"></p>
        </div>

        <div id="dbjunk"><?php echo "Most recent sighting was on: " . $sighting['datetime']?></div>

        <script src="https://code.jquery.com/jquery-1.12.0.min.js"></script>
        <script>window.jQuery || document.write('<script src="js/vendor/jquery-1.12.0.min.js"><\/script>')</script>
        <script src="js/plugins.js"></script>
        <script src="js/main.js"></script>
        <script src="js/polymaps.js"></script>

        <!-- Google Analytics: change UA-XXXXX-X to be your site's ID. -->
        <script>

            var anchLat = 61.1954;
            var anchLon = -149.4784;
            var po = org.polymaps;

            getUserLocation();

            var map = po.map()
                .container(document.getElementById("map").appendChild(po.svg("svg")))
                .add(po.interact())
                .add(po.hash());

            map.add(po.image().url("https://a.tile.openstreetmap.org/{Z}/{X}/{Y}.png"));

            map.zoom(8.25);
            map.center({lat: anchLat, lon: anchLon});
            map.add(po.compass());

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


        </script>
    </body>
</html>
