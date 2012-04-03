<?php

defined('SYSPATH') or die('No direct script access.');

/**
 *
 */
class Controller_Search extends Controller_Data {

    private $layout;

    public function before() {
        parent::before();
        $this->layout = View::factory(I18n::$lang . '/search');
    }

    public function action_index() {
        
    }

    public function action_extended() {
        
    }

    public function after() {
        $this->content = $this->layout->render();
        parent::after();
    }

}