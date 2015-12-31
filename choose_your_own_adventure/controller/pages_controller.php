<?php
    include("abstract_controller.php");

    class PagesController extends AbstractController
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
            parent::render("../view/pages/page_view.php");
        }
        
        public static function to_string()
        {
            return "pages_controller";
        }
        
        public function test()
        {
            echo "Hello";
        }
    }
    
    if(isset($_GET["action"]))
    {
        $pages_controller = new PagesController();
        $action = $_GET["action"];
        $pages_controller->$action();
    }
?>