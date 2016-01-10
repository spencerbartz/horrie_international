<?php
    include "app_model.php";
    
    class UserModel extends AppModel
    {
        public function __construct($first_name, $last_name, $email, $password, $lastLogin, $failed_login_attempts = 0, $date_created = NULL)
        {
            parent::__construct($date_created);
            $this->fields["first_name"] = array($first_name, "VARCHAR(255)");
            $this->fields["last_name"] =  array($last_name, "VARCHAR(255)");
            $this->fields["email"] =  array($email, "VARCHAR(255)");
            $this->fields["password"] =  array(MD5($password), "VARCHAR(512)");
            $this->fields["last_login"] =  array($lastLogin, "TIMESTAMP");
            $this->fields["failed_login_attempts"] =  array($failed_login_attempts, "INT(11)");
        }
        
        public static function find($id)
        {
            $res = parent::find($id, UserModel::get_table_name());
            $um = new UserModel($res["date_created"], $res["first_name"],
                                $res["last_name"], $res["email"], $res["password"],
                                $res["last_login"], $res["failed_login_attempts"]);
            $um->id = $res["id"];
            return $um;
        }
    }
    
   //Test
    function  test()
    {
        $user = new UserModel("Not", "Here", "not.here@nowhere.com", "password", date("Y-m-d H:i:s"), 0);
        $user->save();
        $user->print_fields();
        $user->delete();
    
        $um = UserModel::find(1);
        $um->print_fields();
    }
    
    if($argv[1])
        test();
?>