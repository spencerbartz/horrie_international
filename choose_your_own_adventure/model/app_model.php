<?php
    class AppModel
    {
        public $fields;
        public $tableName;
        
        public function __construct($dateCreated)
        {
            //Initialize fields common to all models
            $this->fields["id"] = NULL;
            $this->fields["last_updated"] = $dateCreated;
            $this->fields["date_created"] = $dateCreated;
            
            $this->tableName = $this->getTableName();
        }
        
        public function __construct_if_not_exists($drop = true)
        {
            include("../util/dbconnect.php");
            include("../util/util.php");
            $sql = "CREATE TABLE IF NOT EXISTS ";
        }
        
        public static function find($id)
        {
            
        }
        
        //Save contents of fields to database
        public function save()
        {
            include("../util/dbconnect.php");
            
            $sql = "";
            $colNames = "";
            $values = "";
            
            foreach($this->fields as $key => $field)
            {
                $field = $field ? "'" . $field . "'" : "NULL";
                $colNames = $colNames . $key . ", ";
                $values = $values . $field . ", ";
            }
            
            $colNames = substr($colNames, 0, strlen($colNames) - 2);
            $values = substr($values, 0, strlen($values) - 2);
            
            $sql = "INSERT INTO " . $this->tableName . " (" . $colNames . ") VALUES (" . $values . ")";
            
            $res = $mysqli->query($sql);
    
            if(!$res)
            {
                echo "Could Not Save Object: " . $mysqli->error;
                die();
            }
        }
        
        public function printFields()
        {
            foreach($this->fields as $key => $field)
            {
                echo $key . ": " . $field . PHP_EOL;
            }
        }
        
        private function getTableName()
        {
            $class = get_called_class();
            $classNameParts = preg_split('/[A-Z]/', $class, -1, PREG_SPLIT_OFFSET_CAPTURE);
            $index = $classNameParts[2][1] - 1;
            return strtolower(substr($class, 0, $index)) . "_" . strtolower(substr($class, $index, strlen($class) - $index)) . "s";
        }
    }
    
?>