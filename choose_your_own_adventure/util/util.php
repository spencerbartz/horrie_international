<?php
    include("router.php");

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
        println('<script type="text/javascript" src="' . $siteRootPath . 'util/util.js"></script>');
    }
    
    function getAppRoot($fileName)
    {
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
            if($parts[$i] === "choose_your_own_adventure")
                break;
            else 
                $path = "../" . $path;
        }
        
        return $path;
    }
?>