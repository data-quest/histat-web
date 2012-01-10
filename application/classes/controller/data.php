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
    }

    public function action_authors() {
        $this->sub_navi->activate(__('Authors'));
    }

}

