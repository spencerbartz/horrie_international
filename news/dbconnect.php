<?php    
    $mysqli = new mysqli(
        config('app.db.host'), 
        config('app.db.user'), 
        config('app.db.pass'), 
        config('app.db.default_db')
    );
    
    if ($mysqli->connect_errno) {
        echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
    }
?>
