<?php
/**
 * Submits a Select * query to mooze.sighting
 * Generates a GeoJSON file containing coordinates
 * of all sightings in DB. Includes custom properties
 * including mooseQty, bearQty, title, and dateTime
 */
require "dbconnect.php";
global $dbCon;
$sql = "SELECT * FROM mooze.sighting";
$statement = $dbCon->prepare($sql);
$statement->execute();
$sighting = $statement->fetchAll();

 header("content-type:application/json");
echo json_encode($sighting);

//Manual JSON generation:
/*
$length = count($sighting);
echo "{\"type\": \"FeatureCollection\",";
echo "\"features\": [";
for ($i = 0; $i < $length; $i++) {
    echo "{ \"type\": \"Feature\",";
    echo "  \"geometry\": {";
    echo "      \"type\": \"point\",";
    echo "      \"coordinates\": [" . $sighting[$i]['longitude'] . ", " . $sighting[$i]['latitude'] . "]";
    echo "  },";
    echo "  \"properties\": {";
    echo "      \"title\": \"sighting" . $sighting[$i]['sightingID'] . "\",";
    echo "      \"mooseQty\": " . $sighting[$i]['mooseqty'] . ",";
    echo "      \"bearQty\":" . $sighting[$i]['bearqty'] . ",";
    echo "      \"dateTime\": \"" . $sighting[$i]['datetime'] . "\"";
    echo "  }";
    echo "}";
    if ($i < $length - 1) {
        echo ",";
    }
}
echo "]}";
*/
?>
