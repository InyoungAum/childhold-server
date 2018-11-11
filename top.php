<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8">
</head> 
<?php
    include_once("db.php");

    $menu = $_GET['menu'];  

    $menus = array(
        "parent_menu" => "보호자",
        "driver_menu" => "운전자"
    )
?>

<html>
    <head>
        <meta http-equiv="content-type" content="text/html; charset=utf-8">
        <meta name="robots" content="noindex, nofollow">
        <title> admin </title>

        <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/latest/css/bootstrap.min.css">
        <script src="//code.jquery.com/jquery.min.js"></script>
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/latest/js/bootstrap.min.js"></script>

        <style>
        /* 사이드바 래퍼 스타일 */
        
        #map {
            height: 400px;  /* The height is 400 pixels */
            width: 100%;  /* The width is the width of the web page */
        }

        #page-wrapper {
            padding-left: 250px;
        }
        
        #sidebar-wrapper {
            position: fixed;
            width: 250px;
            height: 100%;
            margin-left: -250px;
            background: #000;
            overflow-x: hidden;
            overflow-y: auto;
        }
        
        #page-content-wrapper {
            width: 100%;
            padding: 20px;
        }
        /* 사이드바 스타일 */
        
        .sidebar-nav {
            width: 250px;
            margin: 0;
            padding: 0;
            list-style: none;
        }
        
        .sidebar-nav li {
            text-indent: 1.5em;
            line-height: 2.8em;
        }
        
        .sidebar-nav li a {
            display: block;
            text-decoration: none;
            color: #999;
        }
        
        .sidebar-nav li a:hover {
            color: #fff;
            background: rgba(255, 255, 255, 0.2);
        }
        
        .sidebar-nav > .sidebar-brand {
            font-size: 1.3em;
            line-height: 3em;
        }
        
        .sub-header {
            padding-bottom: 10px;
            border-bottom: 1px solid #eee;
        }
        </style>

        <script>
            $(document).ready(function(){
            $("#contact").click(function(){
                $("#contents").load('url to home.php');
                });
            });
        </script>
    </head>
    <body>
        <div id="page-wrapper">
            <!-- 사이드바 -->
            <div id="sidebar-wrapper">
                <ul class="sidebar-nav">
                    <li class="sidebar-brand">
                        <a href="#">Child-Hold(Admin)</a>
                    </li>
                    <?php
                        foreach($menus as $menu_name => $value) {
                            echo '<li id="menu"><a href="'.$menu_name.'.php">'.$value.'</a></li>'; 
                        }
                    ?>
                </ul>
            </div>
            <!-- /사이드바 -->