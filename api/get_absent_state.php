<?php
    header('Content-Type: application/json');
    
    include_once("../db.php");

    $parent_id = $_GET["parent_id"]; 

    global $connect;
    $sql    = 'SELECT p.absent, c.name FROM parent as p, child as c  WHERE p.idx = '.$parent_id.' and c.parent_idx = p.idx';
    $result = mysql_query($sql, $connect);

    if (!$result) {
        echo 'MySQL Error: ' . mysql_error();
        exit;
    }

    $rows = array();
    while($r = mysql_fetch_assoc($result)) {
        $rows['absent'] = $r['absent'];
        $rows['name'] = $r['name']; 
    }
    echo json_encode($rows);
?>