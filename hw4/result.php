<?php

/*Connet MySQL */
$server_name = "localhost:3306";
$server_username = "s403410035";
$server_password = "s403410035";
$dbname = "s403410035";
$connect = mysql_connect($server_name, $server_username, $server_password);
mysql_select_db($dbname);
mysql_set_charset('utf8', $connect);
$now_lat = $_POST['lat'];
$now_lng = $_POST['lng'];
$size = $_POST['size'];

//x = lng
//y = lat 
    $sql="SELECT landmarkna, Y, X, address, (6371* acos(cos( radians($now_lat) ) * cos( radians(Y)) * cos( radians(X) - radians($now_lng)) + sin( radians($now_lat)) * sin(radians(Y) ) ) ) AS distance 
          FROM trainstation
          HAVING distance < $size
          ORDER BY distance
          LIMIT 0,10;";

$response = mysql_query($sql) or die(mysql_error());

$result = array();
$result['length'] = mysql_num_rows($response);
$result['landmarkna'] = array();
$result['landmarkna']['type'] = 'FeatureCollection';
$result['landmarkna']['features'] = array();

$feature = array();
$feature['type'] = 'Feature';
$feature['properties'] = array();
$feature['geometry'] = array();
$feature['geometry']['type'] = 'Point';

while ($row = mysql_fetch_assoc($response)) {
    $feature['properties']['landmarkna'] = $row['landmarkna'];
    $feature['properties']['address'] = $row['address'];
    $feature['properties']['distance'] = $row['distance'];
    
    $feature['geometry']['coordinates'] = array(floatval($row['lng']), floatval($row['lat']));
    $result['landmarkna']['features'][] = $feature;
}

echo json_encode($result);
?>