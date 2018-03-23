<?php
/**
 * Created by Kyle Luoma.
 * Date: 3/23/2018
 * Time: 9:45 AM
 *
 * Inserts sighting object into database.
 * Uses POST method to receive parameters
 * @PARAM
 */


$sql = "INSERT INTO sighting (datetime, latitude, longitude, mooseqty, bearqty) VALUES" . " (" . $_POST['datetime'] . ", ". $_POST['latitude'] . ", " . $_POST['longitude'] . ", " . $_POST['mooseqty'] . ", " . $_POST['bearqty'] . ")";
$statement = $dbCon->prepare($sql);
$statement->execute();



