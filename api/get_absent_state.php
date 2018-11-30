<?php
    header('Content-Type: application/json');
    
    include_once("../db.php");

    $parent_id = $_GET["parent_id"]; 

    global $connect;
    $sql    = 'SELECT absent FROM parent WHERE idx = '.$parent_id;
    $result = mysql_query($sql, $connect);

    if (!$result) {
        echo 'MySQL Error: ' . mysql_error();
        exit;
    }

    $rows = array();
    while($r = mysql_fetch_assoc($result)) {
        $rows['absent'] = $r['absent'];
    }
    echo json_encode($rows);
?>