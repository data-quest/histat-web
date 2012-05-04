<?php

defined('SYSPATH') or die('No direct script access.');

/**
 *
 */
class Controller_Search extends Controller_Data {

    private $layout;
    private $results = array();
    private $show = false;

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
        if (HTTP_Request::POST == $this->request->method()) {
            $post = $this->request->post();
            $search = array(
                'text' => Arr::get($post,'text',__('Searchtext')),
                'theme' => Arr::get($post,'theme','-1'),
                'min' => Arr::get($post,'min',1200),
                'max' => Arr::get($post,'max',2200),
                'title' => Arr::get($post,'title'),
                'source' => Arr::get($post,'source'),
                'description' => Arr::get($post,'description')
            );
            Session::instance()->set('search',$search);
            //Session::instance()->set('search', Arr::merge(Session::instance()->get('search', array()), $this->request->post()));
        }

        $this->layout->checked = true;
        $this->layout->themes = $themes;
    }

    public function action_index() {
        if (HTTP_Request::POST == $this->request->method()) {
            $this->show = true;
            $this->results = ORM::factory('project')->search(Session::instance()->get('search'));
        }
    }

    public function action_extended() {


        if (HTTP_Request::POST == $this->request->method()) {
            $this->layout->checked = false;
            $this->show = true;
            $this->results = ORM::factory('project')->search(Session::instance()->get('search'));;
        }
    }

    public function action_detailed() {
        $this->auto_render = false;
        if (HTTP_Request::POST == $this->request->method()) {
            echo json_encode(ORM::factory('project')->search($this->request->post()));
        }
    }

    public function action_clear() {
        Session::instance()->set('search',array());
    }

    public function after() {
        $view = View::factory(I18n::$lang . '/search/result');

        $view->results = $this->results;
        $view->show = $this->show;
     
        $this->layout->results = $view->render();
        $this->content = $this->layout->render();
        parent::after();
    }

}