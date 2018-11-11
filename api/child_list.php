<?php
    header('Content-Type: application/json');
    
    include_once("../db.php");

    $driver_id = $_GET["driver_id"]; 

    global $connect;
    $sql    = 'SELECT c.idx, c.name, c.beacon_id FROM driver AS d, child AS c, parent AS p WHERE d.idx = '.$driver_id.' AND p.driver_idx = d.idx AND p.idx = c.parent_idx';
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