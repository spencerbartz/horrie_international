<?php
    include("app_model.php");
    
    class PageModel extends AppModel
    {
        // constructor
        public function __construct($dateCreated, $pageText, $questionId, $img_url)
        {
            parent::__construct($dateCreated);
            
            $this->fields["page_text"] = $pageText;
            $this->fields["question_id"] = $questionId;
            $this->fields["image_url"] = $img_url;
        }        
    }
    
    //Test
    $page = new PageModel(date("Y-m-d H:i:s"), "Sample Page Text", 4, "../images/test.png");
    $page->printFields();
    $page->save();
    PageModel::find(3);
?>