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
        $orm          = ORM::factory('Theme')->where('ID_Thema', '<>', $this->config['test_import_id']);

        $themes = array(
            "-1" => __('All')
        );
        foreach ($orm->order_by("Thema")->find_all() as $theme) {
            $themes[$theme->ID_Thema] = $theme->Thema;
        }
        $checked = "on";
        $invalidIds = array(
            Kohana::$config->load('config.example_theme_id'),
            Kohana::$config->load('config.test_import_id')
        );
        foreach ($invalidIds as $id) {
            if (isset($themes[$id])) {
                unset($themes[$id]);
            }
        }

        if (HTTP_Request::POST == $this->request->method()) {
            $post = $this->request->post();
            $checked = null;
            $search = array(
                'text' => Arr::get($post, 'text', __('Searchtext')),
                'theme' => Arr::get($post, 'theme', '-1'),
                'min' => Arr::get($post, 'min', 1200),
                'max' => Arr::get($post, 'max', date('Y',time())),
                'title' => Arr::get($post, 'title', $checked),
                'source' => Arr::get($post, 'source', $checked),
                'description' => Arr::get($post, 'description', $checked)
            );
            Session::instance()->set('search', $search);
        }
        $this->layout->checked = $checked;
        $this->layout->themes = $themes;
    }

    public function action_index() {
        if (HTTP_Request::POST == $this->request->method()) {
            $this->show = true;
            $this->layout->checked = false;
            $this->results = ORM::factory('Project')->search(Session::instance()->get('search'));
        }
    }

    public function action_extended() {


        if (HTTP_Request::POST == $this->request->method()) {
            $this->layout->checked = false;
            $this->show = true;
            $this->results = ORM::factory('Project')->search(Session::instance()->get('search'));
            ;
        }
    }

    public function action_detailed() {
        $this->auto_render = false;
        if (HTTP_Request::POST == $this->request->method()) {
            echo json_encode(ORM::factory('Project')->search($this->request->post()));
        }
    }

    public function action_clear() {
        Session::instance()->set('search', null);
    }

    public function after() {
        $view = View::factory(I18n::$lang . '/search/result');

        if (Session::instance()->get('search')) {
            $view->results = ORM::factory('Project')->search(Session::instance()->get('search'));
            $view->show = true;
          
        } else {
            $view->show = false;
            $view->results = array();
        }
        $this->layout->results = $view->render();
        $this->content = $this->layout->render();
        parent::after();
    }

}