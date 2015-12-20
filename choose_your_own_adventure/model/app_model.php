<?php
    class AppModel
    {
        public $fields;
        public $tableName;
        
        public function __construct($dateCreated, $id = NULL)
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
            
            $sql = "CREATE TABLE IF NOT EXISTS " . $this->getTableName() . "(id INT(11) NOT NULL AUTO INCREMENT, last_updated TIMESTAMP, date_created TIMESTAMP)";
            $res = $mysqli->query($sql);
           
            if(!$res) {
                echo "Could Not Create table for class: " . "blah". " " . $mysqli->error;
                die();
            } 
        }
        
        public static function find($id, $tableName)   
        {
            include("../util/dbconnect.php");
            
            $sql = "SELECT * FROM " . $tableName. " where " .  $tableName . " .id = " . $id;
            
            $res = $mysqli->query($sql);
            
            if(!$res) {
                echo "Could Not find page for id " . $id . " " . $mysqli->error;
                die();
            }
            else{
                if($row = mysqli_fetch_assoc($res))
                    return $row;
                else {
                    echo "Error";
                    die();
                }
            }   
        }
        
        //Save contents of fields to database
        public function save()
        {
            include("../util/dbconnect.php");
            
            $sql = "";
            $colNames = "";
            $values = "";
          
            foreach($this -> fields as $key => $field) {
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
            
            $sql = "SELECT id FROM " . $this->tableName . " ORDER BY id DESC LIMIT 1;";
            
            $res = $mysqli->query($sql);
                
            if(!$res)
            {
                echo "Could Not Save Object: " . $mysqli->error;
                die();
            }
            
            if($row = mysqli_fetch_assoc($res))
            {
                $this->fields["id"] = $row["id"];
            }
        }
        
        public function printFields()
        {
            foreach($this->fields as $key => $field)
            {
                echo $key . ": " . $field . PHP_EOL;
            }
        }
        
        public function getTableName()
        {
            $class = get_called_class();
            $classNameParts = preg_split('/[A-Z]/', $class, -1, PREG_SPLIT_OFFSET_CAPTURE);
            $index = $classNameParts[2][1] - 1;
            return strtolower(substr($class, 0, $index)) . "_" . strtolower(substr($class, $index, strlen($class) - $index)) . "s";
        }
    }
    
?>