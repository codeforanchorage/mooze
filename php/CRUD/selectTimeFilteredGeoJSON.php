<?php
/**
 * Submits a Select between two datetimes query to mooze.sighting
 * Generates a GeoJSON file containing coordinates
 * of all sightings in DB between start and end times. Includes custom properties
 * including mooseQty, bearQty, title, and dateTime
 */
require "dbconnect.php";
require "DBtoGeoJSON.php";
require "GeoJSONtoLayer.php";
global $dbCon;
$sql = "SELECT * FROM mooze.sighting WHERE datetime BETWEEN SUBTIME(:endTime, :timeBack) AND :endTime";
//echo $sql;
$timeBack = "" . $_POST['days'] . " " . $_POST['hours'] . ":" . $_POST['minutes'] . ":0";
//echo $timeBack;
try
{
    $statement = $dbCon->prepare($sql);
    $statement->execute(array(':endTime' => $_POST['endTime'], ':timeBack' => $timeBack));
    $sightingArray = $statement->fetchAll();
    header("content-type:application/json");
    echo json_encode(sightingArrayToGeoJSON($sightingArray));
}
catch(Exception $e)
{
    echo $e;
    exit();
}
?>