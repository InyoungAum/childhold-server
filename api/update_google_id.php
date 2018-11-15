<?php
    header('Content-Type: application/json');
    
    include_once("../db.php");

    $user_type = $_POST["user_type"];
    $user_id = $_POST["user_id"]; 
    $device_id = $_POST["device_id"];

    global $connect;
    $sql    = 'UPDATE '.$user_type.' SET device_id = '.$device_id.' WHERE idx = '.$user_id.';';
    $result = mysql_query($sql, $connect);


    $rows = array();
    if (!$result) {
        $rows["status"] = "fail";
    } else {
        $rows["status"] = "success";
    }

    echo json_encode($rows);
?>