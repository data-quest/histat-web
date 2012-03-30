<?php

defined('SYSPATH') or die('No direct script access.');

/**
 * Controller <b>Table</b> 
 */
class Controller_Download extends Controller_Table {

    public function action_xls() {
        
    }

    public function action_xlsx() {
        
    }

    public function action_csv() {
        
    }

    public function after() {
        $this->action_details();
    
            $view = View::factory(I18n::$lang . '/download');
            $view->action = $this->request->action();
            $view->id_hs = $this->id_hs;
            $view->filter = $this->filter;
            $view->options = Kohana::$config->load('download')->get('options');
            $this->content .= $view->render();
        

        parent::after();
    }

}