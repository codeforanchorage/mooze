
<!doctype html>
<head>

</head>
<body>
<p>Result of insert query:</p>

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
require "dbconnect.php";
global $dbCon;

echo empty($_POST);

try
{
    $sql = "INSERT INTO sighting (datetime, latitude, longitude, mooseqty, bearqty) VALUES" . " ('" . $_POST['datetime'] . "', ". $_POST['latitude'] . ", " . $_POST['longitude'] . ", " . $_POST['mooseqty'] . ", " . $_POST['bearqty'] . ")";
    $statement = $dbCon->prepare($sql);
    $statement->execute();
}
catch(Exception $e)
{
    echo $e;
    exit();
}



?>

</body>