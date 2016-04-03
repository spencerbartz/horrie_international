<?php
    include_once "router.php";
    include_once "print_util.php";
    include_once "url_util.php";
    
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
        
        //Try to support old ass browsers
        println('<!--[if IE 6]><link href="default_ie6.css" rel="stylesheet" type="text/css" /><![endif]-->');
    }
    
    function printAppMenu()
    {
        include_once "../controller/users_controller.php";
        println('<div id="menu">');
        println('<ul>');
        println('<li class="active"><a href="#" accesskey="1" title="">Homepage</a></li>');
        println('<li><a href="#" accesskey="2" title="">Sign in</a></li>');
        println('<li>');
        Router::link_to(UsersController::to_string() , "new_user_landing", "Create Acount", array(), array("acesskey" => "3")) ;
        println('</li>');
        println('<li><a href="#" accesskey="4" title="">About</a></li>');
        println('<li><a href="#" accesskey="5" title="">Contact Us</a></li>');
        println('</ul>');
        println('</div>');
    }
    
    function printCopyright()
    {
        println('<div id="copyright" class="container">');
	println('<p>&copy; 2016 Horrie International. All rights reserved.</p>');
        println('</div>');
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