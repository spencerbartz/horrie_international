<?php 
    
    $local = "true";
    
    if( $local)
    {
        $db_host = "";
        $db_user = "";
        $db_pass = "";
        $db_name= "";
        
    }
    else
    {
        $db_host = "";
        $db_user = "";
        $db_pass = "";
   } 
    $mysqli = new mysqli($db_host, $db_user, $db_pass, $db_name);
    
    if($mysqli->connect_errno) 
    {
        echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
    }
?>
