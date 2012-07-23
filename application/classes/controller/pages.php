<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Pages extends Controller_Index {
    
    public function action_sitemap(){
        
        $view = View::factory(I18n::$lang.'/pages/sitemap');

        $this->content = $view->render();
    }
}