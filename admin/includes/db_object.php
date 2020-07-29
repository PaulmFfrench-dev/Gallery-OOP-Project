<?php 
class Db_object{

    public static function find_all(){ 
        //Error requires late static binding solution
        return static::find_by_query("SELECT * FROM " . static::$db_table . " "); //calls function find_this_query
    }

    public static function find_by_id($id){ 
        global $database;
        $the_result_array = static::find_by_query("SELECT * FROM " . static::$db_table . " WHERE id=$id LIMIT 1");
        
        return !empty($the_result_array) ? array_shift($the_result_array) :false; //If array is not empty, array shift else return false

    }

    public static function find_by_query($sql) {
        global $database;
        $result_set = $database->query($sql);
        $the_object_array = array(); //empty array for objects

        while($row = mysqli_fetch_array($result_set)) { //loop that fetches the table and brings back result_set
            $the_object_array[] = static::instantation($row); //$row(array) in passes into instantation
        }

        return $the_object_array; 
    }

    public static function instantation($the_record){ //loops through the attributes and assigns them to the objects properties
        
        $calling_class = get_called_class();
        $the_object = new $calling_class;

        foreach ($the_record as $the_attribute => $value) { //looping through the table and getting the key of the attribute
            if($the_object->has_the_attribute($the_attribute)){ //If object has an attribute and that attribute has a key
                $the_object->$the_attribute = $value; //if the key exists, the attribute of the object is getting it's value assigned to it.
            }
        }

            return $the_object;
    }

    private function has_the_attribute($the_attribute) {
        $object_properties = get_object_vars($this); //get all attributes from the class
        return array_key_exists($the_attribute, $object_properties); //two parameters, what we want to find and where to find it
    }

    protected function properties(){
        // return get_object_vars($this);
        $properties = array();
        foreach (static::$db_table_fields as $db_field) {
            if(property_exists($this, $db_field)) {
                $properties[$db_field] = $this->$db_field;
            }
        }
        return $properties;
    }

    protected function clean_properties() {
        global $database;
        $clean_properties = array();

        foreach ($this->properties() as $key => $value) {
            
            $clean_properties[$key] = $database->escape_string($value);
        }
        return $clean_properties;
    }
    
    public function save() {
        return isset($this->id) ? $this->update() : $this->create();
    }

    public function create() {
        global $database;
        $properties = $this->clean_properties();

        $sql = "INSERT INTO " .static::$db_table . " (" . implode(",", array_keys($properties)) . ")"; //imploding the properties and seperating by a coma, then pulling the keys out of the array
        $sql .= "VALUES ('". implode("','", array_values($properties)) ."')";
        
        if($database->query($sql)) {
            $this->id = $database->the_insert_id(); //assigning the_insert_id to the object
            return true;
        }else{
            return false;
        }
    }//create method end

    public function update() {
        global $database;
        $properties = $this->clean_properties();
        $property_pairs = array();
        foreach ($properties as $key => $value) {
            $property_pairs[] = "{$key}='{$value}'";
        }

        $sql = "UPDATE " .static::$db_table . " SET ";
        $sql .= implode(",", $property_pairs);
        $sql .= " WHERE id=" . $database->escape_string($this->id);
        $database->query($sql);

        return (mysqli_affected_rows($database->connection) == 1) ? true : false;

    }//

    public function delete(){
        global $database;
        $sql = "DELETE FROM " .static::$db_table . " ";
        $sql .= " WHERE id=" . $database->escape_string($this->id);
        $sql .= " LIMIT 1";
        $database->query($sql);

        return (mysqli_affected_rows($database->connection) == 1) ? true : false;
    }
}

?>