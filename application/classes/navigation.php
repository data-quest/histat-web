<?php defined('SYSPATH') or die('No direct script access.');

class Navigation {
    private $items = array();
    private $level = 0;
    public function __construct($level = 0) {
       $this->level = $level;
    }
    public function add($uri,$title = null){
        $this->items[$this->level][$title] = array('uri' => $uri,'title'=>$title,'active'=>false);
    }
    public function activate($title){
         $this->items[$this->level][$title]['active'] = true;
    }
    public function get_items(){
        return Arr::get($this->items, $this->level,array());
    }
}