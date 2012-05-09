<?php defined('SYSPATH') or die('No direct script access.');
/**
 * class <b>Navigation</b> add and activate navigation points
 */
class Navigation {
    private $items = array();
    private $level = 0;
    /**
     * Setup the level of Navigation Object
     * @param int $level level of navigation. 0 = Main Navi, 1 = Subnavi
     */
    public function __construct($level = 0) {
       $this->level = $level;
    }
    /**
     * Add a new Navigation point to the Object
     * @param string $uri URI of the Navigation
     * @param string $title Title Navigation <b>HTML is allowed(care for XSS!)</b>
     */
    public function add($uri,$title = null){
        $this->items[$this->level][$title] = array('uri' => $uri,'title'=>$title,'active'=>false);
    }
    /**
     * Activate Navigation Item
     * @param string $title Name of navigation Point to activate
     * @example
     * $navi = new Navigation(1); //Create Navigation object for Main Navi <br/>
     * $navi->add('index/foo','Foo'); //Add new Points to Navigation <br/>
     * $navi->add('index/bar','Bar); <br/>
     * $navi->add('index/foobar','FooBar'); <br/>
     * $navi->activate('Bar'); //Activate the Navi Point "Bar" <br/>
     */
    public function activate($title = NULL){
        if($title) {
         $this->items[$this->level][$title]['active'] = true;   
        }else{
            foreach( $this->items[$this->level] as $title => $value){
               $this->items[$this->level][$title]['active'] = false; 
            }
        }
         
    }
    /**
     * Return all Points of the Navigation Object
     * @return array $array[uri|title|active]
     * 
     */
    public function get_items(){
        return Arr::get($this->items, $this->level,array());
    }
}