<?php 
    
    $db_host = "horrieinternationalc.ipagemysql.com";
    $db_user = "newsie";
    $db_host = "localhost";
    $db_user = "root";
    $db_pass = "wewewe99";
    $db_name= "horrie_news_db";
    
    $mysqli = new mysqli($db_host, $db_user, $db_pass, $db_name);
    
    if($mysqli->connect_errno) 
    {
        echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
    }
?>
