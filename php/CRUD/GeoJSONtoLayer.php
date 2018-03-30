<?php
/**
 * Created by Kyle Luoma.
 * Date: 3/30/2018
 * Time: 12:11 PM
 */

function GeoJSONtoLayer($GeoJSONArray) {
    $sourceArray = array (
        "type" => "geojson",
        "data" => $GeoJSONArray
    );

    $layerArray = array(
        "id" => "sightings",
        "type" => "symbol",
        "source" => $sourceArray,
        "layout" => array("icon-image" => "{icon}-15")
    );

    return $layerArray;
}