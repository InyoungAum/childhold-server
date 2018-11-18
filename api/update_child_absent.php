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
    
    echo json_encode($rows);
?>