<?php 
class Db_object{

    protected static $db_table = "users";


    public static function find_all(){ 
        //Error requires late static binding solution
        return static::find_this_query("SELECT * FROM " . static::$db_table . " "); //calls function find_this_query
    }

    public static function find_by_id($user_id){ 
        global $database;
        $the_result_array = static::find_this_query("SELECT * FROM " . static::$db_table . " WHERE id=$user_id LIMIT 1");
        
        return !empty($the_result_array) ? array_shift($the_result_array) :false; //If array is not empty, array shift else return false

    }
    public static function find_this_query($sql) {
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
}

?>