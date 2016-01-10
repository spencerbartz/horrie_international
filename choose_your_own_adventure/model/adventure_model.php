<?php
    include("app_model.php");
    
    class AdventureModel extends AppModel
    {
        // constructor
        public function __construct($date_created, $title, $user_id)
        {
            parent::__construct($date_created);
            
            $this->fields["title"] = array($title, "VARCHAR(512)");
            $this->fields["user_id"] = array($user_id, "INT(11), FOREIGN KEY(user_id) REFERENCES user_models(id)");
            parent::construct_if_not_exists();
        }
        
        public static function find($id)
        {
            $res = parent::find($id, AdventureModel::get_table_name());
            $am = new AdventureModel($res["date_created"], $res["title"], $res["user_id"]);
            $am->id = $res["id"];
            return $am;
        }
    }
    
    //Test
    function test()
    {
        $adv = new AdventureModel(date("Y-m-d H:i:s"), "You shouln't see me" . rand(0, 100000), 3);
        $adv->save();
        $adv->print_fields();
        $adv->delete();
    
         $am = AdventureModel::find(10);
         $am->print_fields();
         
         AdventureModel::find(999);
    }
    
    if($argv[1])
        test();
?>