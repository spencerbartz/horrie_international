<?php
    include_once "app_model.php";

    class QuestionModel extends AppModel
    {
        public function __construct($page_id, $q_and_a, $date_created = NULL)
        {
            parent::__construct($date_created);
            $this->fields["page_id"] = array($page_id, "INT(11), FOREIGN KEY(page_id) REFERENCES page_models(id) ON DELETE CASCADE");
            $this->fields["q_and_a"] = array($q_and_a, "TEXT");
            parent::construct_if_not_exists();
        }
        
        public static function find($id)
        {
            $row = parent::find($id, QuestionModel::get_table_name());
            $qm = new QuestionModel($row["page_id"], $row["q_and_a"], $row["date_created"]);
            $qm->id = $row["id"];
            return $qm;           
        }
        
        public static function first()
        {
            $row =  parent::first(QuestionModel::get_table_name());
            $qm = new QuestionModel($row["page_id"], $row["q_and_a"], $row["date_created"]);
            $qm->id = $row["id"];
            return $qm;
        }
        
        public static function last()
        {
            $row =  parent::last(QuestionModel::get_table_name());            
            $qm = new QuestionModel($row["page_id"], $row["q_and_a"], $row["date_created"]);
            $qm->id = $row["id"];
            return $qm;
        }
    }
    
   //Test
    function  question_model_test($delete)
    {
        include_once "page_model.php";
        
        $qa_pairs = Array("question" => "where would you like to go?" , "answers" => Array("1" => "left", "2" => "right", "3" => "south" ));
        $question = new QuestionModel(PageModel::first()->id, serialize($qa_pairs), date("Y-m-d H:i:s"));
        $question->save();
        $question->print_fields();
        
        $qa_pairs = Array("question" => "Will you open the door?", "answers" => Array("1" => "yes", "2" => "no"));
        $question->set("q_and_a", serialize($qa_pairs));
        $question->save();
        $question->print_fields();
        
        if($delete)
        {
            $question->delete();
        }
        
        $qm = QuestionModel::find(QuestionModel::last()->id);
        $qm->print_fields();
    
        QuestionModel::find(999);
    }
    
    if(isset($argv[1]))
    {
        $delete = isset($argv[2]) ? FALSE : TRUE;
        question_model_test($delete);
    }
?>