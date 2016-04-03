<?php
    function println($text, $webmode = FALSE)
    {
        if($webmode)
            echo $text . "<br/>";
        else
            echo $text . PHP_EOL;	
    }
?>