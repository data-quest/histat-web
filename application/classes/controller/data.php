<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Data extends Controller_Index {

    public function before() {
        parent::before();
        $this->main_navi->activate(__('Data'));
        $this->sub_navi->add('data/index', __('New'));
        $this->sub_navi->add('data/top', __('Top'));
        $this->sub_navi->add('data/times', __('Times'));
        $this->sub_navi->add('data/themes', __('Themes'));
        $this->sub_navi->add('data/authors', __('Authors'));
    }

    public function action_index() {
        $this->sub_navi->activate(__('New'));
        $this->content = 'asd';
    }



    public function action_top() {
        $this->sub_navi->activate(__('Top'));
    }

    public function action_times() {
        $this->sub_navi->activate(__('Times'));
    }

    public function action_themes() {
        $this->sub_navi->activate(__('Themes'));
        $this->scripts[]='jquery.tagsphere.min.js';
        $this->scripts[]='themes.js';
        $themes = array(
            'Geld'=>array('top'=>true),
            'Arbeit'=>array('top'=>true),
            'Bildung'=>array(),
            'Bevölkerung'=>array(),
            'Energie'=>array(),
            'Gesundheit'=>array(),
            'Bauen'=>array(),
            'Handel'=>array('top'=>true),
            'Hanse'=>array(),
            'Innovation'=>array(),
            'Kommunikation'=>array(),
            'Kriminalität'=>array(),
            'Umwelt'=>array(),
            'Städte'=>array(),
            'Landwirtschaft'=>array(),
            'Unternehmen'=>array(),
            'Verbrauch'=>array('top'=>true),
            'Wachstum'=>array(),
            'VGR'=>array(),
            'Wahlen'=>array()
            
        );
        $view = View::factory(I18n::$lang.'/themes');
        $view->themes = $themes;
        $this->content = $view->render();
    }

    public function action_authors() {
        $this->sub_navi->activate(__('Authors'));
    }

}

