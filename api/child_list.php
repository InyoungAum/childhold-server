<?php
    header('Content-Type: application/json');
    
    include_once("../db.php");

    $driver_id = $_GET["driver_id"]; 

    global $connect;
    $sql    = 'SELECT c.idx, c.name, c.beacon_id, p.lat, p.lng FROM driver AS d, child AS c, parent AS p WHERE d.idx = '.$driver_id.' AND p.driver_idx = d.idx AND p.idx = c.parent_idx AND p.absent = 0';
    $result = mysql_query($sql, $connect);

    if (!$result) {
        echo 'MySQL Error: ' . mysql_error();
        exit;
    }

    $ret = array();
    $index = 0; 
    while($r = mysql_fetch_assoc($result)) {
            $rows = array();
                $latlng = array();
                $latlng["lat"] = floatval($r["lat"]);
                $latlng["lng"] = floatval($r["lng"]);
            $rows['idx'] = $r['idx'];
            $rows['name'] = $r['name'];
            $rows['beacon_id'] = $r['beacon_id'];
            $rows['latLng'] = $latlng;
        $ret[$index] = $rows; 
        $index++;
    }
    echo json_encode($ret);
?>