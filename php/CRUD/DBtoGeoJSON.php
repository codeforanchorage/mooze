<?php
/**
 * Created by Kyle Luoma.
 * Date: 3/30/2018
 * Time: 11:38 AM
 */

/**
 * Converts a sighting tuple from the Mooze database into a
 * multi-dimensional array structured for GeoJSON compatibility
 *
 * @param $sightingArray array specifically retrieved from Mooze database
 * @return array structured for GeoJSON encoding
 */
function sightingArrayToGeoJSON($sightingArray) {
    $featuresArray = array();
    for ($i = 0; $i < count($sightingArray); $i++) {
        $geometryArray = array(
            "type" => "Point",
            "coordinates" => array($sightingArray[$i]['longitude'] * 1, $sightingArray[$i]['latitude'] * 1)
        );
        $propertiesArray = array(
            "sightingID" => $sightingArray[$i]['sightingID'] * 1,
            "mooseQty" => $sightingArray[$i]['mooseqty'] * 1,
            "bearQty" => $sightingArray[$i]['bearqty'] * 1
        );
        $singleFeatureArray = array(
            "type" => "Feature",
            "geometry" => $geometryArray,
            "properties" => $propertiesArray
        );
        array_push($featuresArray, $singleFeatureArray);
    }
    $geoJsonArray = array("type" => "FeatureCollection", "features" => $featuresArray);
    return $geoJsonArray;
}
