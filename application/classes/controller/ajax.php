<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Ajax extends Controller_Index {

    public function before() {
        if(!$this->request->is_ajax()){
            throw new HTTP_Exception_404();
        }
        $this->auto_render = FALSE;
        parent::before();
    }

}

