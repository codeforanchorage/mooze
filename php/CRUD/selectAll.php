<?php
require "dbconnect.php";
global $dbCon;
$sql = "SELECT * FROM mooze.sighting";
$statement = $dbCon->prepare($sql);
$statement->execute();
$sighting = $statement->fetchAll();
?>

<!doctype html>
<html class="no-js" lang="">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Select All Scripty</title>

</head>
<body>

<?php
$length = count($sighting);
for ($i = 0; $i < $length; $i++) {
    echo "<p>{sightingID: " . $sighting[$i]['sightingID'] . ",";
    echo " datetime: " . $sighting[$i]['datetime'] . ",";
    echo " latitude: " . $sighting[$i]['latitude'] . ",";
    echo " longitude: " . $sighting[$i]['longitude'] . ",";
    echo " mooseqty: " . $sighting[$i]['mooseqty'] . ",";
    echo " bearqty: " . $sighting[$i]['bearqty'] . "}</p>";
}
?>

</body>
</html>
