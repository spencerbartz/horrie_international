<?php
    include("app_model.php");
    
    class PageModel extends AppModel
    {
        // constructor
        public function __construct($page_text, $question_id, $adventure_id, $img_url, $date_created = NULL)
        {
            parent::__construct($date_created);
            
            $this->fields["page_text"] = array($page_text, "TEXT");
            $this->fields["question_id"] = array($question_id, "INT(11)");
            $this->fields["question_id"] = array($adventure_id, "INT(11)");
            $this->fields["image_url"] = array($img_url, "VARCHAR(512)");
            parent::construct_if_not_exists();
        }
        
        public static function find($id)
        {
            $res = parent::find($id, PageModel::get_table_name());
            $pm = new PageModel($res["date_created"], $res["page_text"], $res["question_id"], $res["image_url"]);
            $pm->fields["id"] = $res["id"];
            return $pm;
        }
    }
    
    //Test
    function test()
    {
        $page = new PageModel("Sample Page Text" . rand(0, 100000), 4, "images/test.png");
        $page->print_fields();
        $page->save();
    
        $page->set("page_text", "Updated Page Text");
        $page->save();
        $page->print_fields();            

         $pm = PageModel::find(61);
         $pm->print_fields();
         
         PageModel::find(999);
     }
     
     if(isset($argv[1]))
        test();
?>