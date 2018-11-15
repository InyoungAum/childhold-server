<?php
    header('Content-Type: application/json');
    
    include_once("../db.php");

    $user_type = $_POST["user_type"];
    $code = $_POST["code"]; 

    global $connect;
    $sql    = 'SELECT idx FROM '.$user_type.' WHERE code = '.$code;
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