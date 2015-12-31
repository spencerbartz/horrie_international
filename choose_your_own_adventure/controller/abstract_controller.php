<?php
    abstract class AbstractController
    {
        public function render($filename)
        {
            $file = fopen( $filename, "r" );
            
            if($file == false )
            {
               echo ( "ERROR: Could not open file: " . $filename . " for reading" );
               exit();
            }
            
            $filesize = filesize( $filename );
            $filetext = fread( $file, $filesize );
            fclose( $file );
            
            echo ( "File size : $filesize bytes" );
            echo $filetext;
        }
    }
    

?>