<?php
require "dbconnect.php";
global $dbCon;
$sql = "SELECT * FROM mooze.sighting";
$statement = $dbCon->prepare($sql);
$statement->execute();
$sighting = $statement->fetchAll();

 header("content-type:application/json");
echo json_encode($sighting);

/* Manual JSON generation:
$length = count($sighting);
for ($i = 0; $i < $length; $i++) {
    echo "<p>{\"sightingID\": \"" . $sighting[$i]['sightingID'] . "\",";
    echo " datetime: " . $sighting[$i]['datetime'] . ",";
    echo " latitude: " . $sighting[$i]['latitude'] . ",";
    echo " longitude: " . $sighting[$i]['longitude'] . ",";
    echo " mooseqty: " . $sighting[$i]['mooseqty'] . ",";
    echo " bearqty: " . $sighting[$i]['bearqty'] . "}</p>";
}
*/
?>
