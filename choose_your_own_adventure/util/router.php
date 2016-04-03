<?php
    include_once "print_util.php";
    include_once "url_util.php";
    
    class Router 
    {
        public function __construct()
        {
        }
        
        public static function link_to($controller, $action, $link_text, $url_attr = array(), $tag_attr = array())
        {        
            $tag_attr_str = "";            
            foreach($tag_attr as $attr => $value)    
                $tag_attr_str .= ' ' . $attr . '="' . $value . '"';
            
            $url_attr_str =  Router::build_url_attr_str($url_attr);
            println('<a href="controller/' . $controller . '.php?action=' . $action . '"'. $url_attr_str . $tag_attr_str . '>' . $link_text . '</a>');
        }
        
        public static function form_action($controller, $action, $url_attr = array())
        {
            $url_attr_str = Router::build_url_attr_str($url_attr);
            print($controller . '.php?action=' . $action . "" . $url_attr_str);
        }
        
        private static function build_url_attr_str($url_attr)
        {
            $url_attr_str = "";
            foreach($url_attr as $attr => $value)
                $url_attr_str .= " " . $attr . "=" . $value . "&";

            //trim off final ampersand
            $url_attr_str = substr($url_attr_str, 0, strlen($url_attr_str) - 1);           
            return $url_attr_str;
        }
    }
?>