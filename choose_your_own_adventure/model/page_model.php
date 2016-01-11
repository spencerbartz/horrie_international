<?php
    include_once "app_model.php";
    
    class PageModel extends AppModel
    {
        // constructor
        public function __construct($page_text, $adventure_id, $img_url, $date_created = NULL)
        {
            parent::__construct($date_created);
            
            $this->fields["page_text"] = array($page_text, "TEXT");
            $this->fields["adventure_id"] = array($adventure_id, "INT(11), FOREIGN KEY(adventure_id) REFERENCES adventure_models(id) ON DELETE CASCADE");
            $this->fields["image_url"] = array($img_url, "VARCHAR(512)");
            parent::construct_if_not_exists();
        }
        
        public static function find($id)
        {
            $row = parent::find($id, PageModel::get_table_name());
            $pm = new PageModel($row["page_text"], $row["adventure_id"], $row["image_url"], $row["date_created"]);
            $pm->id = $row["id"];
            return $pm;
        }
        
        public static function first()
        {
            $row = parent::first(PageModel::get_table_name());
            $pm = new PageModel($row["page_text"], $row["adventure_id"], $row["image_url"], $row["date_created"]);
            $pm->id = $row["id"];
            return $pm;
        }
        
        public static function last()
        {
            $row = parent::last(PageModel::get_table_name());
            $pm = new PageModel($row["page_text"], $row["adventure_id"], $row["image_url"], $row["date_created"]);
            $pm->id = $row["id"];
            return $pm;
        }
    }
    
    //Test
    function page_model_test($delete)
    {
        include "adventure_model.php";
        
        $page = new PageModel("Sample Page Text" . rand(0, 100000), AdventureModel::first()->id, "images/test.png");
        $page->save();
        $page->print_fields();
    
        $page->set("page_text", "Updated Page Text");
        $page->save();
        $page->print_fields();
        
        if($delete)
            $page->delete();

        $pm = PageModel::find(PageModel::last()->id);
        $pm->print_fields();
         
        PageModel::find(999);
     }
     
    if(isset($argv[1]))
    {
        $delete = isset($argv[2]) ? FALSE : TRUE;
        page_model_test($delete);
    }
?>