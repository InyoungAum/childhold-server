<?php
    header('Content-Type: application/json');
    
    include_once("../db.php");

    $driver_id = $_POST["driver_id"];
    $lat = $_POST["lat"]; 
    $lng = $_POST["lng"];

    global $connect;
    $sql    = 'UPDATE driver SET lat = '.$lat.', lng = '.$lng.' WHERE idx = '.$driver_id;
    $result = mysql_query($sql, $connect);


    $rows = array();
    if (!$result) {
        $rows["status"] = "fail";
    } else {
        $rows["status"] = "success";
    }

    echo json_encode($rows);
?>