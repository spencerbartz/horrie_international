<?php

    include 'dbconnect.php';

    /*
    $sql = "drop database if exists newsdb";
    
    if(!$mysqli->query($sql))
    {
        echo "Failed to create database 'newsdb': (" . $mysqli->errno . ") " . $mysqli->error;
        die();
    }
  
    
    $sql = "create database if not exists newsdb";
    
    if(!$mysqli->query($sql))
    {
        echo "Failed to create database 'newsdb': (" . $mysqli->errno . ") " . $mysqli->error;
        die();
    }
      */
    
    $sql = "create table if not exists posts(id int not null auto_increment primary key, posttext text, dateposted timestamp, hashtags varchar(1024))";
    
    if(!$mysqli->query($sql))
    {
        echo "Failed to create table 'posts': (" . $mysqli->errno . ") " . $mysqli->error;
        die();
    }
    
    $postText = "Basic search functionality is now available on spencerbartz.com! Rather than use a \"Search my site\" " .
         	"tool, I decided to make my own. <strong>How it works:</strong> First, my php web-crawling script runs cURL on " .
		"www.spencerartz.com/index.php. The resulting html is scanned for links and is stripped of all tags and " .
		"comments and the remaining text is inserted into a MySQL database. The links on that page are then followed " . 
		"recursively in a depth first search and the same database / link scanning operation is performed until finally " . 
                "a page with no links is found. Thus the site is mapped and the text of all pages is stored in the database. " .
		"Once a day the web-crawler script is run as a cron job to update the contents of the database. Therefore searching " .
		"is only a matter of one simple database query. Search results are displayed simply as links (nothing fancy yet!) " .
		"and the web crawler script still needs some improvements, but it is coming along.";

    $sql = "insert into posts values(NULL, '" . $mysqli->real_escape_string($postText) . "', '2015-03-03 10:27:34', '')";
    
    if(!$mysqli->query($sql))
    {
        echo "Failed to insert post: (" . $mysqli->errno . ") " . $mysqli->error;
        die();
    }
    
    $postText = "The release of Java 1.8 was pretty much the final nail in the coffin of Java Applets. " . 
         	"Given that, I have decided to convert my Java Applet projects to Applications. This will " .
		"give me a chance to review and refactor the source code (assuming I can find it!) for each " .
		"Applet. I have started with my most recent project \"Simple Draw\" which is now <a href=\"applications/simple_draw_2.0/index.php\">available</a>" .
		" in the <a href=\"applications/applicationlist.php\">Java Applications</a> section. ";
                "In the meantime I have discovered the canvas DOM object in HTML 5. It will" .
                "take some getting used to but it seems to be able to do most things applets could do in their heyday.";
    
    
    $sql = "insert into posts values(NULL, '" . $mysqli->real_escape_string($postText) . "', '2015-02-09 15:51:02', '')";
    
    if(!$mysqli->query($sql))
    {
        echo "Failed to insert post: (" . $mysqli->errno . ") " . $mysqli->error;
        die();
    }
    
    $postText = "The <a href=\"php/stammbaum/index.php\">Stammbaum</a> family tree database project is coming along. All the links from the " . 
                "menu actually go somewhere, profile creation is a bit clumsy but works, photo uploads " .
                "to the file system and database entry seem to be working (crosses fingers), editing " .
                "existing photo entries in the database is now possible (profile edit is next to add), and " .
                "finally simple search functionality has been added.";
    
    $sql = "insert into posts values(NULL, '" . $mysqli->real_escape_string($postText) . "', '2015-01-16 20:14:11', '')";
    
    if(!$mysqli->query($sql))
    {
        echo "Failed to insert post: (" . $mysqli->errno . ") " . $mysqli->error;
        die();
    }
    
    $postText = "The latest release of Java has tightened security restrictions. To run any of the Applets on this " . 
                "site, a <a href=\"http://www.java.com/en/download/help/jcp_security.xml\" target=\"new\">security exception</a> for http://spencerbartz.com. must be created in the <a href=\"https://www.java.com/en/download/exception_sitelist.jsp\" target=\"new\">Exception Site List.</a>" .
                "Additional parts of the Applets may not function correctly so I will probably " .
                "need to update deprecated code and recompile each one. " .
                "Work on \"Stammbaum\" in the PHP section is progressing, but unfortunately ipage's hosting plan comes " . 
                "with a database which requires all database users be associated with a database. The idea for Stammbaum " .
                "was to create a new database (each identical in table structure) for each family line. Of course this " . 
                "works fine when you get to be your own DBA, but now I have no other option but to cram all the tables into " .
                "one database.";
    
    $sql = "insert into posts values(NULL, '" . $mysqli->real_escape_string($postText) . "', '2014-12-21 17:46:58', '')";
    
    if(!$mysqli->query($sql))
    {
        echo "Failed to insert post: (" . $mysqli->errno . ") " . $mysqli->error;
        die();
    }
    
    $postText = "The Contact / Resume page has now been remodeled with a form for sending messages. " . 
              	"Javascript form validation is minimal at the moment but input sanitization will be added shortly. " .
                "Work on the site-wide search feature is coming along. More testing is necessary.";
            
            
    $sql = "insert into posts values(NULL, '" . $mysqli->real_escape_string($postText) . "', '2014-11-23 09:51:26', '')";    
            
    if(!$mysqli->query($sql))
    {
        echo "Failed to insert post: (" . $mysqli->errno . ") " . $mysqli->error;
        die();
    }
?>