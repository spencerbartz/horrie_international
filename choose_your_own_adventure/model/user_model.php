<?php
    include_once "app_model.php";
    
    class UserModel extends AppModel
    {
        public function __construct($first_name, $last_name, $email, $password, $last_login, $failed_login_attempts = 0, $date_created = NULL)
        {
            parent::__construct($date_created);
            $this->fields["first_name"] = array($first_name, "VARCHAR(255)");
            $this->fields["last_name"] =  array($last_name, "VARCHAR(255)");
            $this->fields["email"] =  array($email, "VARCHAR(255)");
            $this->fields["password"] =  array(MD5($password), "VARCHAR(512)");
            $this->fields["last_login"] =  array($last_login, "TIMESTAMP");
            $this->fields["failed_login_attempts"] =  array($failed_login_attempts, "INT(11)");
            parent::construct_if_not_exists();
        }
        
        public static function find($id)
        {
            //TODO find a way to move this logic up into app_model.php so every model doesn't have all this crap
            $row = parent::find($id, UserModel::get_table_name());
            $um = new UserModel($row["first_name"],
                                $row["last_name"], $row["email"], $row["password"],
                                $row["last_login"], $row["failed_login_attempts"], $row["date_created"]);
            $um->id = $row["id"];
            return $um;
        }

        public static function first()
        {
            $row =  parent::first(UserModel::get_table_name());
            $um = new UserModel($row["first_name"],
                                $row["last_name"], $row["email"], $row["password"],
                                $row["last_login"], $row["failed_login_attempts"], $row["date_created"]);
            $um->id = $row["id"];
            return $um;
        }
        
        public static function last()
        {
            $row =  parent::last(UserModel::get_table_name());
            $um = new UserModel($row["date_created"], $row["first_name"],
                                $row["last_name"], $row["email"], $row["password"],
                                $row["last_login"], $row["failed_login_attempts"]);
            $um->id = $row["id"];
            return $um;
        }
    }
    
   //Test
    function  user_model_test($delete)
    {
        $user = new UserModel("Not", "Here", "not.here@nowhere.com", "password", date("Y-m-d H:i:s"));
        $user->save();
        $user->print_fields();
        
        $user->set("failed_login_attempts", 3);
        $user->set("first_name", "User");
        $user->set("last_name", "McUsage");
        $user->save();
        $user->print_fields();
        
        if($delete)
            $user->delete();
    
        $um = UserModel::find(UserModel::first()->id);
        $um->print_fields();

        $um = UserModel::find(UserModel::last()->id);
        $um->print_fields();
        
        UserModel::find(999);
    }
        
    if(isset($argv[1]))
    {
        $delete = isset($argv[2]) ? FALSE : TRUE;
        user_model_test($delete);
    }
?>