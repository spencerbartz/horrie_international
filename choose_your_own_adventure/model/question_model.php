<?php
    include("app_model.php");
    
    class QuestionModel extends AppModel
    {
        // constructor
        public function __construct($q_and_a_pairs, $date_created)
        {
            parent::__construct($date_created);
            $this->fields["q_and_a"] = serialize($q_and_a_pairs);
        }
        
        public static function find($id)
        {
            $res = parent::find($id, QuestionModel::getTableName());
            $qm = new QuestionModel($res["date_created"], unserialize($res["q_and_a"]));
                $qm->fields["id"] = $res["id"];
            return $qm;           
        }
    }

    //Test
    $qaArray =   Array( "question" => "where would you like to go?" , "answers" => Array("1" => "left", "2" => "right", "3" => "south" ) );
    $question = new QuestionModel(date("Y-m-d H:i:s"), $qaArray);
    $question->save();
    $question->printFields();
    
    $q = QuestionModel::find(15);
    $q->printFields();
    
?>