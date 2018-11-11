<?php
    header('Content-Type: application/json');
    
    include_once("../db.php");

    $driver_id = $_GET["driver_id"]; 

    global $connect;
    $sql    = 'SELECT lat, lng FROM parent WHERE driver_idx = '.$driver_id.' AND absent != 1 ORDER BY visit_order';
    $result = mysql_query($sql, $connect);

    if (!$result) {
        echo 'MySQL Error: ' . mysql_error();
        exit;
    }

    $rows = array();
    while($r = mysql_fetch_assoc($result)) {
        $rows[] = $r;
    }
    echo json_encode($rows);
?>