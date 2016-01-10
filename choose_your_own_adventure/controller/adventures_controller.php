<?php

    class StoriesController extends AbstractController
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
            parent::render("../view/stories/story_view.php");
        }
        
        public static function to_string()
        {
            return "stories_controller";
        }
    }
?>