<?php
    header('Content-Type: application/json');
    
    include_once("../db.php");

    $child_id = $_POST["child_id"];
    $lat = $_POST["lat"]; 
    $lng = $_POST["lng"];

    global $connect;
    $sql    = 'UPDATE child SET lat = '.$lat.', lng = '.$lng.' WHERE idx = '.$child_id;
    $result = mysql_query($sql, $connect);


    $rows = array();
    if (!$result) {
        $rows["status"] = "fail";
    } else {
        $rows["status"] = "success";
    }

    echo json_encode($rows);
?>