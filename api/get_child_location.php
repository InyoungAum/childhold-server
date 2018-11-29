<?php
    header('Content-Type: application/json');
    
    include_once("../db.php");

    $parent_id = $_POST["parent_id"]; 

    $driver_lat = 0;
    $driver_lng = 0;
    $child_lat = 0; 
    $child_lng = 0;

    global $connect;
    $sql    = 'SELECT d.lat, d.lng FROM driver AS d, parent AS p WHERE p.idx = '.$parent_id.' AND d.idx = p.driver_idx';
    $result = mysql_query($sql, $connect);

    if (!$result) {
        echo 'MySQL Error: ' . mysql_error();
        exit;
    }

    $rows = array();
    
    while($r = mysql_fetch_assoc($result)) {
        $driver_lat = $r['lat'];
        $driver_lng = $r['lng'];
    }

    //애기 위치 찾기
    $sql    = 'SELECT c.lat, c.lng FROM child AS c, parent AS p WHERE p.idx = '.$parent_id.' AND c.parent_idx = p.idx';
    $result = mysql_query($sql, $connect);

    if (!$result) {
        echo 'MySQL Error: ' . mysql_error();
        exit;
    }

    $rows = array();
    
    while($r = mysql_fetch_assoc($result)) {
        $child_lat = $r['lat'];
        $child_lng = $r['lng'];
    }

    if ($child_lat != 0 && $child_lng != 0) {
        $rows["lat"] = $child_lat; 
        $rows["lng"] = $child_lng; 
    } else {
        $rows["lat"] = $driver_lat; 
        $rows["lng"] = $driver_lng;
    }
    echo json_encode($rows);
?>