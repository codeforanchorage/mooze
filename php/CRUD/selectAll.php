<?php
/**
 * Created by PhpStorm.
 * User: KYLE
 * Date: 3/6/2018
 * Time: 6:31 PM
 */
require "//dbconnect.php";
global $dbcon;
$sql = "SELECT * FROM mooze.sighting";
$statement = $dbCon->prepare($sql);
$statement->execute();
$sighting = $statement->fetch();

for ($i = 0; $i <= $sighting->length-1; $i++) {
    for ($j = 0; $j <= $sighting[$i]->length-1; $j++)
    {
        echo "<p>" . $sighting[$i][$j] . "</p>";
    }
}
?>