<?php
    include_once "app_model.php";
    
    class AdventureModel extends AppModel
    {
        // constructor
        public function __construct($title, $user_id, $date_created = NULL)
        {
            parent::__construct($date_created);
            
            $this->fields["title"] = array($title, "VARCHAR(512)");
            $this->fields["user_id"] = array($user_id, "INT(11), FOREIGN KEY(user_id) REFERENCES user_models(id) ON DELETE CASCADE");
            parent::construct_if_not_exists();
        }
        
        public static function find($id)
        {
            $row = parent::find($id, AdventureModel::get_table_name());
            $am = new AdventureModel($row["title"], $row["user_id"], $row["date_created"]);
            $am->id = $row["id"];
            return $am;
        }
        
        public static function first()
        {
            $row =  parent::first(AdventureModel::get_table_name());
            $am = new AdventureModel($row["title"], $row["user_id"], $row["date_created"]);
            $am->id = $row["id"];
            return $am;
        }
        
        public static function last()
        {
            $row =  parent::last(AdventureModel::get_table_name());
            $am = new AdventureModel($row["title"], $row["user_id"], $row["date_created"]);
            $am->id = $row["id"];
            return $am;
        }
    }
    
    //Test
    function adventure_model_test($delete)
    {
        include "user_model.php";
        $adv = new AdventureModel("Sample Title_" . rand(0, 100000), UserModel::last()->id, date("Y-m-d H:i:s"));
        $adv->save();
        $adv->print_fields();
        
        $adv->set("title", "This is a new title buddy!");
        $adv->save();
        $adv->print_fields();
        
        if($delete)
            $adv->delete();
        
        $am = AdventureModel::find(AdventureModel::first()->id);
        $am->print_fields();
         
        AdventureModel::find(999);
    }    

    if(isset($argv[1]))
    {
        $delete = isset($argv[2]) ? FALSE : TRUE;
        adventure_model_test($delete);
    }
?>