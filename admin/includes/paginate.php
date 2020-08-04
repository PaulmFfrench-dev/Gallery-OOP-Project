<?php 
class Paginate {

    public $current_page;
    public $items_per_page;
    public $items_total_count;

    public function __construct($page=1, $items_per_page=4, $item_total_count=0){
        $this->$current_page      = (int)$page;
        $this->$items_per_page    = (int)$items_per_page;
        $this->$items_total_count = (int)$items_total_count;
    }

    public function next(){
        return $this->current_page + 1;
    }

    public function previous(){
        return $this->current_page - 1;
    }

    public function page_total(){ //total_count is coming from index.php on main directory
        return ceil($this->items_total_count/$this->items_per_page); //Gettings total amount of pages through dividing all items by item limit per page 
    }

    public function has_previous(){
        return $this->previous() >= 1 ? true : false; // If previous method is bigger or equal to 1, then there is a previous page
    }

    public function has_next(){
        return $this->next() <= $this->page_total() ? true : false; //Will set to false if there are no more pages, therefore stops pagination
    }

    public function offset(){
        return ($this->current_page -1) * $this->items_per_page; //If items per page is 10, it will show 1 to 10, then the next set would 11 to 21
    }
}

?>