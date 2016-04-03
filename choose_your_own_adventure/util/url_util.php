<?php
 function getAppRoot($fileName)
    {   
        if(ends_with($fileName, "_view.php"))
        {
            return "../";
        }
        
        $parts = explode("\\", $fileName);
                
        //Check for file system that uses / instead of \
        if(count($parts) == 1)
        {
            $parts = explode("/", $fileName);
        }
        
        //Trick to figure out path to css and js util files.
        $path = "";
        for($i = count($parts) - 2; $i > 0; $i--)
        {
            if($parts[$i] == "choose_your_own_adventure")
                break;
            else 
                $path = "../" . $path;
        }
        
        return $path;
    }
?>