<?php

    function println($s, $html = false) {
        if($html === false)
            echo $s . "\n";
        else
            echo $s . "<br/>";
    }
?>