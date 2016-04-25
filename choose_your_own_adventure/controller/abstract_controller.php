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

        public static function to_string()
        {
            return "Error abstract base class instantiated";
        }
        
        public static function process_request()
        {
            if(isset($_GET["controller"]) && isset($_GET["action"]))
            {
                $controller_name = ucfirst($_GET["controller"]) . "Controller";
              
                if($controller_name !== get_called_class())
                    return;
                
                $controller = new $controller_name();
                $action = $_GET["action"];
                $controller->$action();
            }        
        }
    }
?>