<?php
    header('Content-Type: application/json');
    
    include_once("../db.php");

    $parent_id = $_GET["parent_id"]; 
    $is_absent = $_GET["absent"];

    global $connect;
    $sql    = 'UPDATE parent SET absent = '.$is_absent.' WHERE idx = '.$parent_id;
    $result = mysql_query($sql, $connect);

    if (!$result) {
        echo 'MySQL Error: ' . mysql_error();
        exit;
    }

    $rows = array();
    if (!$result) {
        $rows["status"] = "fail";
    } else {
        $rows["status"] = "success";
    }

    $sql    = 'SELECT d.device_id AS id FROM driver AS d, parent AS p WHERE p.driver_idx = d.idx AND p.idx = '.$parent_id;
    $result2 = mysql_query($sql, $connect);

    while($r = mysql_fetch_assoc($result2)) {
        $rows["driverId"] = $r["id"];
    }

    echo json_encode($rows);
?>