<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Controller <b>Data</b> 
 */
class Controller_Data extends Controller_Index {

    public function before() {
        parent::before();
        //Activate Data navigation point
        $this->main_navi->activate(__('Data'));
        //Add sub navigation items
        $this->sub_navi->add('data/index', __('New'));
        $this->sub_navi->add('data/top', __('Top'));
        $this->sub_navi->add('data/times', __('Times'));
        $this->sub_navi->add('data/themes', __('Themes'));
        $this->sub_navi->add('data/authors', __('Authors'));
    }

    public function action_index() {
        $this->scripts[]='data_new.js';
        //Activate sub navigation point "New"
        $this->sub_navi->activate(__('New'));
        //Load model/project.php
        $project = ORM::factory('project');
        //Load view/<lang>/data/index.php
        $view = View::factory(I18n::$lang.'/data/index');
        //Assign new projects
        $view->projects = $project->new_projects();
        //set content
        $this->content = $view->render();
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
        $themes_orm = ORM::factory('theme');
        $total = 0;
        $themes_tmp = $themes_orm->getThemes()->order_by('summe','DESC')->as_object()->execute();
        foreach($themes_tmp as $theme){
            $total += $theme->summe;
        }
        $themes = array();
        $i = 0;
        foreach($themes_tmp as $theme){
             $themes[$theme->Thema] = array('top'=>($i < 5)?true:false,'count'=>15+ceil(($theme->summe/$total)*100));
             $i++;
        }
        $view = View::factory(I18n::$lang.'/themes');
        $view->themes = $themes;
        $this->content = $view->render();
    }

    public function action_authors() {
        $this->sub_navi->activate(__('Authors'));
    }

}

