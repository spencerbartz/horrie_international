<?php
    include_once  "abstract_controller.php";
    
    class AdventuresController extends AbstractController
    {
       // constructor
        public function __construct()
        {
       
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
            parent::render("../view/adventures/new_adventure_view.php");
        }
        
        public static function to_string()
        {
            return "adventures_controller";
        }
    }
?>