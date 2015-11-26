<?php
    include("app_model.php");
    
    class QuestionModel extends AppModel
    {
        // constructor
        public function __construct($id, $dateCreated, $text)
        {
            parent::__construct($id, $dateCreated);
            
            $this->fields["text"] = $text;
        }
        
        public function save()
        {
            
        }
    }

    //Test    
    $question = new QuestionModel("1", date("Y-m-d H:i:s"), "Sample Question");
    $question->printFields();
    QuestionModel::find(3);
    
?>