<?php 

class User{

    public $id;
    public $username;
    public $password;
    public $first_name;
    public $last_name;

    public static function find_all_users(){
        return self::find_this_query("SELECT * FROM users"); //calls function find_this_query
    }

    public static function find_user_by_id($user_id){ 
        global $database;
        $the_result_array = self::find_this_query("SELECT * FROM users WHERE id=$user_id LIMIT 1");
        
        return !empty($the_result_array) ? array_shift($the_result_array) :false; //If array is not empty, array shift else return false

    }
    
    public static function verify_user($username, $password){
        global $database;
        $username = $database->escape_string($username);
        $password = $database->escape_string($password);

        $sql = "SELECT * FROM users WHERE ";
        $sql .= "username = '{$username}' ";
        $sql .= "AND password = '{$password}' ";
        $sql .= "LIMIT 1";

        $the_result_array = self::find_this_query($sql);
        return !empty($the_result_array) ? array_shift($the_result_array) :false;
    }

    public static function find_this_query($sql) {
        global $database;
        $result_set = $database->query($sql);
        $the_object_array = array(); //empty array for objects

        while($row = mysqli_fetch_array($result_set)) { //loop that fetches the table and brings back result_set
            $the_object_array[] = self::instantation($row); //$row(array) in passes into instantation
        }

        return $the_object_array; 
    }

    public static function instantation($the_record){ //loops through the attributes and assigns them to the objects properties
        $the_object = new self;

            // $the_object ->id         = $found_user ['id'];
            // $the_object ->username   = $found_user ['username'];
            // $the_object ->password   = $found_user ['password'];
            // $the_object ->first_name = $found_user ['first_name'];
            // $the_object ->last_name  = $found_user ['last_name'];

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

    public function create() {
        global $database;
        $sql = "INSERT INTO users (username, password, first_name, last_name)";
        $sql .= "VALUES ('";
        $sql .= $database->escape_string($this->username) . "', '";
        $sql .= $database->escape_string($this->password) . "', '";
        $sql .= $database->escape_string($this->first_name) . "', '";
        $sql .= $database->escape_string($this->last_name) . "')";
        
        if($database->query($sql)) {
            $this->id = $database->the_insert_id(); //assigning the_insert_id to the object
            return true;
        }else{
            return false;
        }
    }//create method end

    public function update() {
        global $database;
        $sql = "UPDATE users SET ";
        $sql .= "username='"   . $database->escape_string($this->username)   ."',";
        $sql .= "password='"   . $database->escape_string($this->password)   ."',";
        $sql .= "first_name='" . $database->escape_string($this->first_name) ."',";
        $sql .= "last_name='"  . $database->escape_string($this->last_name)  ."' ";
        $sql .= " WHERE id=" . $database->escape_string($this->id);
        $database->query($sql);

        return (mysqli_affected_rows($database->connection) == 1) ? true : false;

    }//

    public function delete(){
        global $database;
        $sql = "DELETE FROM users ";
        $sql .= " WHERE id=" . $database->escape_string($this->id);
        $sql .= " LIMIT 1";
        $database->query($sql);

        return (mysqli_affected_rows($database->connection) == 1) ? true : false;
    }
}



?>