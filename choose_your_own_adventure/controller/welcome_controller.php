<?php
    include_once "abstract_controller.php";
    
    class WelcomeController extends AbstractController
    {
        public function __construct()
        {
        }
        
        public function welcome_landing()
        {
            parent::render("../view/welcome/welcome_landing_view.php");
        }
        
        public static function to_string()
        {
            return "welcome_controller";
        }
    }
    
    WelcomeController::process_request();
?>