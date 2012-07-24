<?php

defined('SYSPATH') or die('No direct script access.');

class Controller_Stats extends Controller_Admin {



    public function action_index() {
      $this->action_users();
    }

    public function action_users() {
         $this->sub_navi->activate(__('Stats'));
         $this->scripts[]='stats.js';
        $view = View::factory(I18n::$lang.'/admin/stats/index');
     
        $this->content = $view->render();
    }
      
}