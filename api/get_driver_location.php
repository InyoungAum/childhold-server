<?php
    header('Content-Type: application/json');
    
    include_once("../db.php");

    $parent_id = $_GET["parent_id"]; 

    global $connect;
    $sql    = 'SELECT d.lat, d.lng FROM driver AS d, parent AS p WHERE p.idx = '.$parent_id.' AND d.idx = p.driver_idx';
    $result = mysql_query($sql, $connect);

    if (!$result) {
        echo 'MySQL Error: ' . mysql_error();
        exit;
    }

    $rows = array();
    while($r = mysql_fetch_assoc($result)) {
        $rows['lat'] = $r['lat'];
        $rows['lng'] = $r['lng'];
    }
    echo json_encode($rows);
?>