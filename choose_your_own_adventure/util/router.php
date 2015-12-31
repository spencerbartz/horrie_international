<?php
    include('controller/pages_controller.php');

    class Router 
    {
        public function __construct()
        {
        }
        
        public static function link_to($controller, $action, $link_text, $tag_attr = array())
        {
            $attr_str = "";
            foreach($tag_attr as $attr => $value)
            {
                $attr_str = " " . $attr . "=" . $value . "&";
            }
            
            $attr_str = substr($attr_str, 0, strlen($attr_str) - 1);
            
            echo '<a href="controller/' . $controller . '.php?action=' . $action . '"'. $attr_str . '>' . $link_text . '</a>';
        }
    }
?>