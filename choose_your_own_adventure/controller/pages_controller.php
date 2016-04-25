<?php
    include_once  "abstract_controller.php";
    
    class PagesController extends AbstractController
    {
        public function __construct()
        {
            $page = NULL;
        }
        
        public function create()
        {
            
        }
        
        public function index()
        {
            
        }
        
        public function destroy()
        {
            
        }
        
        public function new_page_landing()
        {
            parent::render("../view/pages/page_view.php");
        }
        
        public static function to_string()
        {
            return "pages_controller";
        }
    }
    
    PagesController::process_request();
?>