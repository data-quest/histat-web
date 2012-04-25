<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Controller <b>Ajax</b>  can be called only with jQuery.ajax methods
 */
class Controller_About extends Controller_Index {
    
    public function action_index(){
        $view = View::factory(I18n::$lang.'/pages/about');
        $this->content = $view->render();
    }
}