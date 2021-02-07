<?php

function printPageDeclaration($siteRootPath) {
    //declare HTML page
    println('<!doctype html>');
    println('<head>');
    println('<title>Horrie International Enterprises Inc. Ltd.</title>');
    
    //Set the character set to show umlauts
    println('<meta http-equiv="Content-Type" content="text/html;charset=iso-8859-1" />');
    
    //Information for search engine indexing
    println('<meta name="Description" content="Business investment opportunities for the 23th century at HorrieInternational DOT COM!" />');
    println('<meta name="Keywords" content="Horrie, International, Enterprises, Philipp, Hein, Germany, USA, America, Party, Techno" />');
    
    //CSS and favicon
    println('<link rel="stylesheet" href="' . $siteRootPath . 'css/horriestyle.css" type="text/css" />');
    println('<link rel="shortcut icon" href="' . $siteRootPath . 'img/favicon.ico" />');
    
    //JS
    println('<script type="text/javascript" src="' . $siteRootPath . 'util/js/lib/jquery-1.11.2.min.js"></script>');
    println('<script type="text/javascript" src="' . $siteRootPath . 'util/js/lib/underscore-min.js"></script>');
    println('<script type="text/javascript" src="' . $siteRootPath . 'util/js/jquery_extend.js" site_root="' . $siteRootPath . '"></script>');
    println('<script type="text/javascript" src="' . $siteRootPath . 'util/js/search_text_highlighter.js"></script>');
    println('<script type="text/javascript" src="' . $siteRootPath . 'util/js/util.js"></script>');
}

function printHeader($siteRootPath) {
    println('<div id="header" class="header rounded">' );
    println('<img src="' . $siteRootPath . 'img/mainlogo.jpg" class="rounded" />');
    println('<div class="mainheader"><h2>What have you done for us lately?</h2></div>');
    println('<div class="mainmenu">');
    println('<div class="menubutton rounded"><a href="' . $siteRootPath . 'index.php">Home</a></div>');
    println('<div class="menubutton rounded"><a href="">Products and Services</a></div>');
    println('<div class="menubutton rounded"><a hef="">People</a></div>');
    println('<div class="menubutton rounded"><a href="">Support</a></div>');
    println('<div class="menubutton rounded"><a href="' . $siteRootPath . 'login/login.php">Login / Sign Up!</a></div>');
    println('</div>');
    println('</div>');
}

function printNewsArchives() {
    include "news/dbconnect.php";

    $sql = "SELECT * FROM posts ORDER BY dateposted DESC";
    $res = $mysqli->query($sql);
    
    if (!$res) {
        echo $mysqli->error;
    }
    
    if ($res->num_rows == 0) {
        println("table was empty");    
    }

    $years = Array();   
    $months = Array();
    $year = "";
    $month = "";
    
    while($row = $res->fetch_assoc()) {
        $dateposted = $row["dateposted"];
        $year = date("Y",  strtotime($dateposted));
        
        if (end($years) !== $year) {
            array_push($years, $year);
            println("</ul>" . $year  . "<ul>");
        }

        $month = date("F",  strtotime($dateposted));
        $month_num = date("m",  strtotime($dateposted));
        
        if (end($months) !== $month) {
            array_push($months, $month);
            println("<li><a href=\"news/archive_view.php?datetime=" . $dateposted . "&year=" . $year . "&month=" . $month_num . "\">" . $month . "</a></li>");    
        }   
    }
}

function printArchivesForDate($year, $month) {
    include "../news/dbconnect.php";
    $sql = "SELECT id, posttext, hashtags, dateposted FROM posts WHERE YEAR(dateposted) =" . $year . " AND MONTH(dateposted) = ". $month . " ORDER BY dateposted DESC";

    $res = $mysqli->query($sql);
    
    if (!$res) {
        println('<div class="box rounded">');
        println('<span class="white"> Sorry, there was an error. Please try again later.</span>');
        println("DB ERROR BUDDY " . $mysqli->error);
        println('</div>');
        return;
    }
    
    if ($res->num_rows > 0) {
        while($row = $res->fetch_assoc()) {
            println('<div class="box rounded">');
            println('<h1 class="news-story-title">Archived News: ' . date('F jS, Y', strtotime($row['dateposted'])) . '</h1>');
            println('<p class="box-content">' . $row['posttext'] . '</p>');
            println('<p class="post-footer align-right"> <span class="date">Date Posted: ' . $row['dateposted'] . '</span> </p>');
            println('</div>');
        }
    } else {
        println('<div class="box rounded">');
        println('<span class="white"> Sorry, there were no posts in this category   . Please try again later.</span>');
        println('</div>');        
    }
}

function printNews() {
    include "news/dbconnect.php";
    $sql = "SELECT posttext, hashtags, dateposted FROM posts ORDER BY dateposted DESC LIMIT 3";
    
    $res = $mysqli->query($sql);
    if (!$res) {
        println('<div class="box rounded">');
        println('<span class="white"> Sorry, Horrie International news is not available right now. Please try again later.</span>');
        println('</div>');
    }
    
    if ($res->num_rows > 0) {
        while($row = $res->fetch_assoc()) {
            println('<div class="box rounded">');
            println('<h1 class="news-story-title">Latest News: ' . date('F jS, Y', strtotime($row['dateposted'])) . '</h1>');
            println('<p class="box-content">' . $row['posttext'] . '</p>');
            println('<p class="post-footer align-right"> <span class="date">Date Posted: ' . $row['dateposted'] . '</span> </p>');
            println('</div>');
        }
    } else {
        println('<div class="box rounded">');
        println('<h1><span class="white">There are no news stories yet.</span></h1>');
        println('</div>');
    }
}


function printCategories() {
    $categories = '<ul>' .
                    '<li><a href="https://spencerbartz.com/horrieinternational/camerons_corner/index.php">Cameron\'s Corner</a></li>' .
                    '<li><a href="http://spencerbartz.com/horrieinternational/garys_corner/index.php">Gary\'s Corner</a></li>' .
                    '<li><a href="https://en.wikipedia.org/wiki/Weltpolitik">World Politik</a></li>' .
                    '<li><a href="https://en.wikipedia.org/wiki/Sport_in_Germany">Sport Europa</a></li>' .
                    '<li><a href="networking/networking.php">Networking</a></li>' .
                    '<li><a href="http://www.nature.com/news/specials/africa/index.html">Nature - Africa</a></li>' .
                    '<li><a href="http://lyricstranslate.com/en/blaue-augen-blue-eyes.html">SuperCool</a></li>' .
                    '<li><a href="http://www.bmw.com/com/de/">Die coolsten Autos</a></li>' .
                  '</ul>';
                  
    println($categories);
}

function getPathToRootDir($fileName) {
    $parts = explode("\\", $fileName);
            
    //Check for file system that uses / instead of \
    if (count($parts) == 1) {
        $parts = explode("/", $fileName);
    }
    
    //Trick to figure out path to css and js util files.
    $path = "";
    for($i = count($parts) - 2; $i > 0; $i--) {
        if ($parts[$i] === "horrieinternational" || $parts[$i] === "ipg.horrieinternationalc")
            break;
        else 
            $path = "../" . $path;
    }
    
    return $path;
}

function printFooter($siteRootPath) {
        println('<img src="' . $siteRootPath . 'img/footerlogo.jpg" />');
        println("", TRUE);
        println('All rights reserved. &copy; Philipp Hein 2016');
}

function println($text, $webmode = FALSE) {
    if ($webmode) {
        echo $text . "<br/>";
    } else {
        echo $text . PHP_EOL;
    }	
}

function alert($msg) {
    echo '<script type="text/javascript">alert("' . $msg . '");</script>';
}

function console_log($msg) {
    echo '<script type="text/javascript">console.log(' . $msg . ');</script>';  
}

function convertToSnakeCase($string) {
    $string = preg_replace("([A-Z]+)",   "_$0", $string, 5);
    return substr(strtolower($string), 1, strlen($string));
}

?>