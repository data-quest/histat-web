<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Controller <b>Ajax</b>  can be called only with jQuery.ajax methods
 */
class Controller_Ajax extends Controller_Index {

    public function before() {
        //Check if the Request is called with xHTTPRequest else throw exception
        if(!$this->request->is_ajax()){
            throw new HTTP_Exception_404();
        }
        //Disable render content
        $this->auto_render = FALSE;
        parent::before();
    }

}

