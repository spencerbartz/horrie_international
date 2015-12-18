<?php
    include("app_model.php");
    
    class UserModel extends AppModel
    {
      // constructor
        public function __construct($dateCreated, $firstName, $lastName, $email, $password, $lastLogin, $failedLoginAttempts = 0)
        {
            parent::__construct($dateCreated);
            $this->fields["first_name"] = $firstName;
            $this->fields["last_name"] = $lastName;
            $this->fields["email"] = $email;
            $this->fields["password"] = MD5($password);
            $this->fields["last_login"] = $lastLogin;
            $this->fields["failed_login_attempts"] = $failedLoginAttempts;
        }
        
        public static function find($id)
        {
            $res = parent::find($id, UserModel::getTableName());
            $um = new UserModel($res["date_created"], $res["first_name"],
                                $res["last_name"], $res["email"], $res["password"],
                                $res["last_login"], $res["failed_login_attempts"]);
            $um->fields["id"] = $res["id"];
            return $um;           
        }        
    }
    
        //Test
    $user = new UserModel(date("Y-m-d H:i:s"), "Hank", "Jones", "hjones@gmail.com", "some stupid dog", date("Y-m-d H:i:s"), 0);
    $user->printFields();
    $user->save();

     $u= UserModel::find(1);
     $u->printFields();
    
?>