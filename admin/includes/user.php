<?php 

class User{

    public $id;
    public $username;
    public $password;
    public $first_name;
    public $last_name;

    public static function find_all_users(){
        return self::find_this_query("SELECT * FROM users");
    }

    public static function find_user_by_id($user_id){
        global $database;
        $result_set = self::find_this_query("SELECT * FROM users WHERE id=$user_id LIMIT 1");
        $found_user = mysqli_fetch_array($result_set);
        return $found_user;
    }
    
    public static function find_this_query($sql) {
        global $database;
        $result_set = $database->query($sql);
        $the_object_array = array(); //empty array for objects

        while($row = mysqli_fetch_array($result_set)) { //loop that fetches the table and brings back result_set
            $the_object_array[] = self::instantiation($row);
        }

        return $the_object_array; 
    }

    public static function instantiation($the_record){ //loops through the attributes and assigns them to the objects properties
        $the_object = new self();
            // $the_object ->id         = $found_user ['id'];
            // $the_object ->username   = $found_user ['username'];
            // $the_object ->password   = $found_user ['password'];
            // $the_object ->first_name = $found_user ['first_name'];
            // $the_object ->last_name  = $found_user ['last_name'];

        foreach ($the_record as $the_attribute => $value) { //looping through the table and getting the key of the attribute
            if($the_object->has_the_attribute($the_attribute)){ 
                $the_object->the_attribute = $value; //if the key exists, the attribute of the object is getting it's value assigned to it.
            }
        }

            return $the_object;
    }

    private function has_the_attribute($the_attribute) {
        $object_properties = get_object_vars($this);
        array_key_exists($the_attribute, $object_properties); //two parameters, what we want to find and where to find it
    }
}



?>