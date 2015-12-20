<?php

function printPageDeclaration($siteRootPath)
{
    //declare HTML page
    println('<!doctype html>');
    println('<head>');
    
    //Set the character set to show umlauts
    println('<meta http-equiv="Content-Type" content="text/html;charset=iso-8859-1" />');
    
    //Information for search engine indexing
    println('<meta name="Description" content="Business investment opportunities for the 23th century at HorrieInternational DOT COM!" />');
    println('<meta name="Keywords" content="Horrie, International, Enterprises, Philipp, Hein, Germany, USA, America, Party, Techno" />');
    
    //CSS and favicon
    println('<link rel="stylesheet" href="' . $siteRootPath . 'css/horriestyle.css" type="text/css" />');
    println('<link rel="shortcut icon" href="' . $siteRootPath . 'img/favicon.ico" />');
    
    //JS
    println('<script type="text/javascript" src="' . $siteRootPath . 'util/jquery-1.11.2.min.js"></script>');
    println('<script type="text/javascript" src="' . $siteRootPath . 'util/underscore-min.js"></script>');
    println('<script type="text/javascript" src="' . $siteRootPath . 'util/util.js"></script>');
}

function printHeader($siteRootPath)
{
    $header = '<div id="header" class="header rounded">' .
                '<img src="' . $siteRootPath . 'img/mainlogo.jpg" class="rounded" />' .
                '<div class="mainheader"><h2>What have you done for us lately?</h2></div>' .
                '<div class="mainmenu">' .
                  '<div class="menubutton rounded"><a href="' . $siteRootPath . 'index.php">Home</a></div>' .
                  '<div class="menubutton rounded"><a href="">Products and Services</a></div>' .
                  '<div class="menubutton rounded"><a href="">People</a></div>' .
                   '<div class="menubutton rounded"><a href="">Support</a></div>' .
                '</div>' .
              '</div>';
    
    println($header);
}

function printNews()
{
    include 'news/dbconnect.php';

    $sql = "SELECT posttext, hashtags, dateposted FROM posts ORDER BY dateposted DESC";
    
    if(!$res = $mysqli->query($sql))
    {
        println('<div class="box rounded">');
        println('<span class="white"> Sorry, Horrie International news is not available right now. Please try again later.</span>');
        //LOGGER INFO (" . $mysqli->errno . ") " . $mysqli->error;
        println('</div>');
        die();
    }
    
    if($res->num_rows > 0)
    {
        while($row = $res->fetch_assoc())
        {
            println('<div class="box rounded">');
            println('<h1 class="news-story-title">Latest News: ' . date('F jS, Y', strtotime($row['dateposted'])) . '</h1>');
            println('<p class="box-content">' . $row['posttext'] . '</p>');
            println('<p class="post-footer align-right"> <span class="date">Date Posted: ' . $row['dateposted'] . '</span> </p>');
            println('</div>');
        }
    }
    else
    {
        println('<div class="box rounded">');
        println('<h1><span class="white">There are no news stories yet.</span></h1>');
        println('</div>');
    }
}


function printCategories()
{
    $categories = '<ul>' .
                    '<li><a href="#">World Politics</a></li>' .
                    '<li><a href="#">Europe Sport</a></li>' .
                    '<li><a href="#">Networking</a></li>' .
                    '<li><a href="#">Nature - Africa</a></li>' .
                    '<li><a href="#">SuperCool</a></li>' .
                    '<li><a href="#">Last Category</a></li>' .
                  '</ul>';
                  
    println($categories);
}

function printArchives()
{
    $archives = '<ul>' .
                  '<li><a href="#">Januar 2015</a></li>' .
                  '<li><a href="#">Februar 2015</a></li>' .
                  '<li><a href="#">März 2015</a></li>' .
                  '<li><a href="#">April 2015</a></li>' .
                  '<li><a href="#">Mai 2015</a></li>' .
                  '<li><a href="#">Juni 2015</a></li>' .
                  '<li><a href="#">Juli 2015</a></li>' .
                  '<li><a href="#">August 2015</a></li>' .
                  '<li></li>' .
                  '<li><a href="#">September 2014</a></li>' .
                  '<li><a href="#">Oktober 2014</a></li>' .
                  '<li><a href="#">November 2014</a></li>' .
                  '<li><a href="#">Dezember 2014</a></li>' .
                '</ul>';
                
    println($archives);
}

function getPathToRootDir($fileName)
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
        if($parts[$i] === "horrieinternational" || $parts[$i] === "horrieinternationalc")
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

function printAlert($msg)
{
    echo '<script type="text/javascript">alert("' . $msg . '");</script>';
}

function convertToSnakeCase($string)
{
    $string = preg_replace("([A-Z]+)",   "_$0", $string, 5);
    return substr(strtolower($string), 1, strlen($string));
}

?>