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
        if (HTTP_Request::POST == $this->request->method()) {

            $orm = ORM::factory('project');
            $this->results = $orm->search($this->request->post());
        }
    }

    public function action_index() {
        
    }

    public function action_extended() {
        if (HTTP_Request::POST == $this->request->method()) {
            $orm = ORM::factory('project');
            $orm->search();
            $this->results = array(
                '12345' => array(
                    'header' => array(
                    ),
                    'source' => array(),
                    'details' => array()
                ),
                'asdasd123' => array(
                ),
                'asd23123' => array(
                )
            );
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