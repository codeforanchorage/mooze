<?php
require "/dbconnect.php";
global $dbcon;
$sql = "SELECT * FROM mooze.sighting";
$statement = $dbCon->prepare($sql);
$statement->execute();
$sighting = $statement->fetch();
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
echo "<p> Testing CRUD: </p>";
for ($i = 0; $i < $length; $i++) {
    echo "<p> 1. " . $sighting[$i]['sightingID'] . "</p>";
    echo "<p> 2. " . $sighting[$i]['datetime'] . "</p>";
    echo "<p> 3. " . $sighting[$i]['latitude'] . "</p>";
    echo "<p> 4. " . $sighting[$i]['longitude'] . "</p>";
}
?>

</body>
</html>
