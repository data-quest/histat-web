<?php

defined('SYSPATH') or die('No direct script access.');

/**
 *
 */
class Controller_Search extends Controller_Data {

    private $layout;
    private $results = array();

    public function before() {
        parent::before();
        $this->layout = View::factory(I18n::$lang . '/search/layout');
        $orm = ORM::factory('theme');

        $themes = array(
            "-1" => __('All')
        );
        foreach ($orm->order_by("Thema")->find_all() as $theme) {
            $themes[$theme->ID_Thema] = $theme->Thema;
        }
        $this->layout->themes = $themes;
        $results = array();
        if (HTTP_Request::POST == $this->request->method()) {

            $orm = ORM::factory('project');
            $results = $orm->search($this->request->post());
           
            if(count($results) > 0){
              
               $results = $orm->where('ID_Projekt','IN',$results)->find_all();
             
            }
             
            $this->results =$results;
        }
    }

    public function action_index() {
        
    }

    public function action_extended() {
        if (HTTP_Request::POST == $this->request->method()) {
          
        }
    }

    public function after() {
        $view = View::factory(I18n::$lang . '/search/result');
        $view->results = $this->results;
        $this->layout->results = $view->render();
        $this->content = $this->layout->render();
        parent::after();
    }

}