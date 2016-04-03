<?php
    include_once "abstract_controller.php";
    
    class UsersController extends AbstractController
    {
       // constructor
        public function __construct()
        {
            $user = NULL;
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
        
        public function new_user_landing()
        {
            parent::render("../view/users/new_user_view.php");
        }
        
        public static function to_string()
        {
            return "users_controller";
        }
    }
    
    //UsersController::construct_if_not_exists();
    
    if(isset($_GET["action"]))
    {
        $users_controller = new UsersController();
        $action = $_GET["action"];
        $users_controller->$action();
    }
?>