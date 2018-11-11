<?php
    global $connect; 
    $mysql_hostname = 'localhost';
    $mysql_username = 'cxcv92';
    $mysql_password = 'tksguqvm123!';
    $mysql_database = 'cxcv92';
    $mysql_port = '3306';
    $mysql_charset = 'utf8';
    
    $connect = @mysql_connect($mysql_hostname.':'.$mysql_port, $mysql_username, $mysql_password); 

    if(!$connect) {
        echo '[연결실패] : '.mysql_error().''; 
        die('MySQL 서버에 연결할 수 없습니다.');
    }

    @mysql_select_db($mysql_database, $connect) or die('DB 선택 실패');

    mysql_query(' SET NAMES '.$mysql_charset);

    if(!$connect) {
        echo '[연결실패] : '.mysql_error().''; 
        die('MySQL 서버에 연결할 수 없습니다.');
    }
?>