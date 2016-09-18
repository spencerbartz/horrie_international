<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>Horrie International Hall of Fame</title>
</head>
<body bgcolor=black>

<?php
$dir = 'uploads';
if ($handle = opendir($dir)) 
{
	while (false !== ($entry = readdir($handle))) 
	{
    		if($entry == '.' || $entry == '..')
    			continue;
    		
    		echo '<img src="'. $dir . '/' . $entry . '">';
    		echo '<br>';
    		echo '<a href="'. $dir . '/' . $entry . '">' . $entry . '</a>';
    		echo '<br><br>';
    	}
    	
    	closedir($handle);
}
?>
<body>
</html>

