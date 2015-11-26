<?php
    include 'util.php';
   
    function find($objectType = "AppModel", $id=1)
    {
         include 'dbconnect';
        //$dbName = (convertToSnakeCase($objectType));
        $sql = "SELECT * FROM " . conertToSnakeCase($objectType)  . "s LIMIT 1";
         echo  conertToSnakeCase($objectType);
        die();
        if($res = $mysqli -> query($sql))
         {
             echo "Failed to insert post: (" . $mysqli -> errno . ") " . $mysqli -> error;
             die();
         }


        if(!$res)
        {
            return false;
        }

        if($res->num_rows > 0)
        {
            while($row = $res->fetch_assoc())
            {
                echo '<tr class="row-a"><td class="first"><a href="newsadmin.php?postid=' .  $row["id"] . '">' . $row["id"] . '</a></td><td><a href="newsadmin.php?postid=' .  $row["id"] . '">' . $row["dateposted"] . "</a></td><td>" . $row["preview"] . '...</td><td><a href="newsadmin.php?postid='. $row["id"] . '">Edit</a> / <a href="#" onclick="deleteWarning(' . $row["id"] . ');">Delete</a></td></tr>'; 
            }
        }
    }
    
    
    find("PageModel");
?>