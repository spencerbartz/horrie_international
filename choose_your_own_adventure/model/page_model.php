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
        
        public static function find($id)
        {
            $res = parent::find($id, PageModel::getTableName());
            $pm = new PageModel($res["date_created"], $res["page_text"], $res["question_id"], $res["image_url"]);
            $pm->fields["id"] = $res["id"];
            return $pm;
        }
    }
    
    //Test
    $page = new PageModel(date("Y-m-d H:i:s"), "Sample Page Text" . rand(0, 100000) . "blah", 4, "../images/" . rand(0,99999) . "test.png");
    //$page->printFields();
    $page->save();

     $pm = PageModel::find(61);
     $pm->printFields();
?>