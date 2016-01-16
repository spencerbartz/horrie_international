<?php
    include "router.php";
    
    function printPageDec($siteRootPath)
    {
        //declare HTML page
        println('<!doctype html>');
        println('<head>');
        
        //Set the character set to show umlauts
        println('<meta http-equiv="Content-Type" content="text/html;charset=iso-8859-1" />');
        
        //CSS and favicon
        println('<link rel="shortcut icon" href="' . $siteRootPath . 'img/favicon.ico" />');
        println('<link href="http://fonts.googleapis.com/css?family=Didact+Gothic" rel="stylesheet" />');
        println('<link href="' . $siteRootPath . 'css/default.css" rel="stylesheet" type="text/css" media="all" />');
        println('<link href="' . $siteRootPath . 'css/fonts.css" rel="stylesheet" type="text/css" media="all" />');
   
        //JS
        println('<script type="text/javascript" src="' . $siteRootPath . 'util/jquery-1.11.2.min.js"></script>');
        println('<script type="text/javascript" src="' . $siteRootPath . 'util/underscore-min.js"></script>');
        println('<script type="text/javascript" src="' . $siteRootPath . 'util/fx.js"></script>');
        println('<script type="text/javascript" src="' . $siteRootPath . 'util/util.js"></script>');
    }
    
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
    
    function println($text, $webmode = FALSE)
    {
        if($webmode)
            echo $text . "<br/>";
        else
            echo $text . PHP_EOL;	
    }
    
    //From http://stackoverflow.com/questions/834303/startswith-and-endswith-functions-in-php
    function starts_with($haystack, $needle)
    {
        // search backwards starting from haystack length characters from the end
        return $needle === "" || strrpos($haystack, $needle, -strlen($haystack)) !== FALSE;
    }
    
    //From http://stackoverflow.com/questions/834303/startswith-and-endswith-functions-in-php
    function ends_with($haystack, $needle)
    {
        // search forward starting from end minus needle length characters
        return $needle === "" || (($temp = strlen($haystack) - strlen($needle)) >= 0 && strpos($haystack, $needle, $temp) !== FALSE);
    }
?>