<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Widget extends Controller {

    public function before() {
        parent::before();
        if ($this->request === Request::initial()) {
            throw new HTTP_Exception_404();
        }
    }

}

