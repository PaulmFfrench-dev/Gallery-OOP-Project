<?php 
class Paginate {

    public $current_page;
    public $items_per_page;
    public $item_total_count;

    public function __construct($page=1, $items_per_page=4, $item_total_count=0){
        $this->$current_page     = (int)$page;
        $this->$items_per_page   = (int)$items_per_page;
        $this->$item_total_count = (int)$item_total_count;
    }

    
}

?>