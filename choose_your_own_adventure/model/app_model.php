<?php
    include("../util/util.php");

    class AppModel
    {
        public $fields;
        public $tableName;
        
        public function __construct($dateCreated = NULL)
        {
            //Initialize fields common to all models
            $this->id = NULL;
            $dateCreated = $dateCreated ? $dateCreated : date("Y-m-d H:i:s");
            $this->fields["last_updated"] = array($dateCreated, "TIMESTAMP");
            $this->fields["date_created"] = array($dateCreated, "TIMESTAMP");    
            $this->tableName = $this->get_table_name();            
        }
        
        public function construct_if_not_exists($drop = true)
        {
            include("../util/dbconnect.php");
            $additional_fields = "";
            
            foreach($this->fields as $field => $attr)
                $additional_fields .= $field . " " . $attr[1] . ", ";
            
            $sql = "CREATE TABLE IF NOT EXISTS " . $this->get_table_name() . "(id INT(11) NOT NULL AUTO_INCREMENT, " . $additional_fields . "PRIMARY KEY(id))";
            $res = $mysqli->query($sql);
            
            if(!$res)
                die("FATAL ERROR connecting to database: " . $mysqli->error);
        }
        
        public static function find($id, $tableName)   
        {
            include("../util/dbconnect.php");
            $sql = "SELECT * FROM " . $tableName. " where " .  $tableName . " .id = " . $id;
            $res = $mysqli->query($sql);
            
            if(!$res)
            {
                die("Could Not find Object for id " . $id . " " . $mysqli->error);
            }
            else if(isset($res->num_rows) && $res->num_rows == 0)
            {
                println("Record not found");
                return;
            }
            else
            {
                if($row = mysqli_fetch_assoc($res))
                    return $row;
                else
                    die("An error occurred: " . $mysqli->error);
            }   
        }
        
        //Save contents of fields to database
        public function save()
        {
            include("../util/dbconnect.php");
            $sql = $col_names = $values = "";
          
            foreach($this->fields as $field => $attr) 
            {    
                $col_names .= $field . ", ";
                $values .= "'" . $mysqli->real_escape_string($attr[0]) . "', ";
            }
            
            //cut off final commas and spaces
            $col_names = substr($col_names, 0, strlen($col_names) - 2);
            $values = substr($values, 0, strlen($values) - 2);
            
            //make mysql query
            $sql = "INSERT INTO " . $this->tableName . " (" . $col_names . ") VALUES (" . $values . ")";
            $res = $mysqli->query($sql);  
            
            if(!$res)
            {
                die("FATAL: Could Not Save Object: " . $mysqli->error . PHP_EOL);
            }
            else if (isset($res->num_rows) && $res->num_rows == 0)
            {
                println("Object not found" . __LINE__);
                return;
            }
            
            //confirm the object was saved
            $sql = "SELECT id FROM " . $this->tableName . " ORDER BY id DESC LIMIT 1;";
            $res = $mysqli->query($sql);
            
            if(!$res)
                die("FATAL: Could Not Save Object: " . $mysqli->error);
            else if(isset($res->num_rows) && $res->num_rows == 0)
                println("Could Not Save Object " . __LINE__); 
            
            if($row = mysqli_fetch_assoc($res))
                $this->id = $row["id"];
        }
        
        public function delete()
        {
            include("../util/dbconnect.php");
            
            //make mysql query
            $sql = "DELETE FROM " . $this->tableName . " WHERE id = " . $this->id;
            $res = $mysqli->query($sql);
            
            if(!$res)
            {
                die("FATAL: Could Not Delete Object: " . $mysqli->error);
            }
            else if(isset($res->num_rows) && $res->num_rows == 0)
            {
                println("Object not found");
                return;
            }
            
            //confirm the object was deleted
            $sql = "SELECT * FROM " . $this->tableName . " WHERE id = " . $this->id;
            $res = $mysqli->query($sql);
            
            if(!$res)
                die("FATAL: Could not delete Object: " . $mysqli->error);
            else if(isset($res->num_rows) && $res->num_rows != 0)
                println("Could not delete Object" . __LINE__);
        }
        
        public function print_fields()
        {
            println("id: " . $this->id);
            foreach($this->fields as $field => $attr)
                if(isset($this->fields[$field]))
                    println($field . ": " . $attr[0]);
        }
        
        public function get_table_name()
        {
            $class = get_called_class();
            $class_name_parts = preg_split('/[A-Z]/', $class, -1, PREG_SPLIT_OFFSET_CAPTURE);
            $index = $class_name_parts[2][1] - 1;
            return strtolower(substr($class, 0, $index)) . "_" . strtolower(substr($class, $index, strlen($class) - $index)) . "s";
        }
    }
?>