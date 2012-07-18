<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Controller <b>Ajax</b>  can be called only with jQuery.ajax methods
 */
class Controller_Galery extends Controller_Index {
    
    public function action_index(){
         $this->main_navi->activate(__('Galery'));
        $view = View::factory(I18n::$lang.'/pages/galery');
        $this->content = $view->render();
    }
}