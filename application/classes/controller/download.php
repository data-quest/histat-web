<?php

defined('SYSPATH') or die('No direct script access.');

/**
 * Controller <b>Table</b> 
 */
class Controller_Download extends Controller_Table {
    public function action_xls() {
       echo $this->filter;
    }
}