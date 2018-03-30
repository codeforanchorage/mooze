<?php
/**
 * Submits a Select * query to mooze.sighting
 * Generates a GeoJSON file containing coordinates
 * of all sightings in DB. Includes custom properties
 * including mooseQty, bearQty, title, and dateTime
 */
require "dbconnect.php";
require "DBtoGeoJSON.php";

global $dbCon;
$sql = "SELECT * FROM mooze.sighting";
$statement = $dbCon->prepare($sql);
$statement->execute();
$sightingArray = $statement->fetchAll();

header("content-type:application/json");
echo json_encode(sightingArrayToGeoJSON($sightingArray));

?>
