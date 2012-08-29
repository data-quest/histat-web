<?php

defined('SYSPATH') or die('No direct script access.');

class Controller_Pages extends Controller_Index {

    public function action_sitemap() {

        $view = View::factory(I18n::$lang . '/pages/sitemap');

        $this->content = $view->render();
    }

    public function action_about() {
        $this->main_navi->activate(__('About'));
        $view = View::factory(I18n::$lang . '/pages/about');
        $this->content = $view->render();
    }

    public function action_galery() {
        $this->main_navi->activate(__('Galery'));
        $view = View::factory(I18n::$lang . '/pages/galery');
        $this->content = $view->render();
    }

}