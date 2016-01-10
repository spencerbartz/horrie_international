<?php
    abstract class AbstractController
    {
        public static function render($filename)
        {            
            $filetext = AbstractController::render_php_to_str($filename); 
            echo $filetext;
        }
    
        private function render_php_to_str($file, $vars=null)
        {
            if (is_array($vars) && !empty($vars))
            {
                extract($vars);
            }
            
            ob_start();
            include $file;
            return ob_get_clean();
        }    
    }
?>