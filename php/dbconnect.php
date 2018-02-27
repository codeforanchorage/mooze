<?php

$host = "localhost";
$dbname = "mooze";
$username = "mooze_client";
$password = "bullwinkle";

try
{
    $dbCon = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    echo "Connected to database!";
}
catch(Exception $e)
{
    echo "Unable to connect to database!";
    exit();
}

$dbCon -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
?>