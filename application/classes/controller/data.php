<?php

defined('SYSPATH') or die('No direct script access.');

/**
 * Controller <b>Data</b> 
 */
class Controller_Data extends Controller_Index {

    protected $dialog = "";

    public function before() {
        parent::before();
        //Activate Data navigation point
        $this->main_navi->activate(__('Data'));
        //Add sub navigation items
        $this->sub_navi->add('data/index', __('New'));
        $this->sub_navi->add('data/top', __('Top'));
        $this->sub_navi->add('data/times', __('Times'));
        $this->sub_navi->add('data/themes', __('Themes'));
        $this->sub_navi->add('data/names', __('Names'));
    }

    public function action_index() {
        //Activate sub navigation point "New"
        $this->sub_navi->activate(__('New'));
        //Load model/project.php
        $project = ORM::factory('project');
        //Load view/<lang>/data/index.php
        $view = View::factory(I18n::$lang . '/data/index');
        //Load view/<lang>/project/list.php prepare the subview
        $list = View::factory(I18n::$lang . '/project/list');
        //assign new projects to subview
        $list->projects = $project->new_projects();
        //assign the referrer uri
        $list->uri = URL::site(I18n::$lang . '/data/index');
        //Assign list in view
        $view->list = $list->render();
        //Setup Dialog
        $view->dialog = $this->dialog;
        //set content
        $this->content = $view->render();
        //Setup last action
        $this->session->set('action', array('name' => 'index'));
    }

    public function action_top() {
        $this->sub_navi->activate(__('Top'));
    }

    public function action_themes($id = NULL) {
        $this->sub_navi->activate(__('Themes'));
        if (!$id)
            $id = $this->request->param('id');

        if (!$id) {
            $this->scripts[] = 'jquery.tagsphere.min.js';
            $this->scripts[] = 'themes.js';
            $orm = ORM::factory('theme');
            $total = 0;
            $themes_tmp = $orm->getThemes()->order_by('summe', 'DESC')->as_object()->execute();
            foreach ($themes_tmp as $theme) {
                $total += $theme->summe;
            }
            $themes = array();
            $i = 0;
            foreach ($themes_tmp as $theme) {
                $themes[$theme->Thema] = array('top' => ($i < 5) ? true : false, 'count' => 15 + ceil(($theme->summe / $total) * 100), 'id' => $theme->ID_Thema);
                $i++;
            }

            $view = View::factory(I18n::$lang . '/data/themes/cloud');
            $view->themes = $this->shuffle_assoc($themes);
        } else {
            $orm = ORM::factory('theme', $id);
            $view = View::factory(I18n::$lang . '/data/themes/overview');
            $view->theme_list = $orm->getThemes()->as_object()->execute();

            //Load view/<lang>/project/list.php prepare the subview
            $list = View::factory(I18n::$lang . '/project/list');
            //assign new projects to subview
            $list->projects = $orm->projects;
            //assign the referrer uri
            $list->uri = URL::site(I18n::$lang . '/data/themes/' . $id);
            //Assign list in view
            $view->list = $list->render();
        }
        //Setup Dialog
        $view->dialog = $this->dialog;
        $this->content = $view->render();
        $this->session->set('action', array('name' => 'themes', 'param' => $id));
    }

    public function action_times($id = NULL) {
        $this->sub_navi->activate(__('Times'));
        if (!$id)
            $id = $this->request->param('id');

        if (!$id) {
            $this->scripts[] = 'jquery.tagsphere.min.js';
            $this->scripts[] = 'themes.js';
            $orm = ORM::factory('time');
            $total = 0;
            $times_tmp = $orm->getTimes()->order_by('summe', 'DESC')->as_object()->execute();
            foreach ($times_tmp as $time) {
                $total += $time->summe;
            }
            $times = array();
            $i = 0;
            foreach ($times_tmp as $time) {
                $times[$time->Zeit] = array('top' => ($i < 5) ? true : false, 'count' => 15 + ceil(($time->summe / $total) * 100), 'id' => $time->ID_Zeit);
                $i++;
            }

            $view = View::factory(I18n::$lang . '/data/times/cloud');
            $view->times = $this->shuffle_assoc($times);
        } else {
            $orm = ORM::factory('time', $id);
            $view = View::factory(I18n::$lang . '/data/times/overview');
            $view->time_list = $orm->getTimes()->as_object()->execute();

            //Load view/<lang>/project/list.php prepare the subview
            $list = View::factory(I18n::$lang . '/project/list');
            //assign new projects to subview
            $list->projects = $orm->projects;
            //assign the referrer uri
            $list->uri = URL::site(I18n::$lang . '/data/times/' . $id);
            //Assign list in view
            $view->list = $list->render();
        }
        //Setup Dialog
        $view->dialog = $this->dialog;
        $this->content = $view->render();
        $this->session->set('action', array('name' => 'times', 'param' => $id));
    }

    public function action_names($id = NULL) {
        $this->sub_navi->activate(__('Names'));

        if (!$id)
            $id = urldecode($this->request->param('id'));


        $orm = ORM::factory('project');
        $view = View::factory(I18n::$lang . '/data/names/overview');
        $authors = $orm->getAuthors();
        $author_list = array();
        $key_list = array();
        foreach ($authors as $author) {
            $names = explode(';', $author->Projektautor);
            if (count($names) > 0) {
                foreach ($names as $name) {
                    $name = trim(str_replace(array('(', ')'), array(''), $name));
                    $author_id = md5($name);
                    $key = strtoupper($name[0]);
                    $key_list[$key] = $key;
                    $author_list[$key][$author_id] = $name;
                }
            } else {
                $name = $names;
                $author_id = md5($name);
                $key = strtoupper($name[0]);
                $key_list[$key] = $key;
                $author_list[$key][$author_id] = $name;
            }
        }


        ksort($author_list);
        ksort($key_list);
        $view->author_list = $author_list;
        $view->key_list = $key_list;
        $view->projects = '';
        if ($id) {
            $projects = ORM::factory('project')->where('ID_Thema', '!=', $this->config->get('example_theme_id'))->where('Projektautor', 'LIKE', '%' . $id . '%');
            $list = View::factory(I18n::$lang . '/project/list');
            $list->projects = $projects;
            //assign the referrer uri
            $list->uri = URL::site(I18n::$lang . '/data/names/' . urlencode($id)) . '#' . md5($id);
            $view->projects = $list->render();
        }
        $view->name = $id;
        //Setup Dialog
        $view->dialog = $this->dialog;
        $this->content = $view->render();
        $this->session->set('action', array('name' => 'names', 'param' => $id));
    }

    private function shuffle_assoc($array) {
        $keys = array_keys($array);
        shuffle($keys);
        return array_merge(array_flip($keys), $array);
    }

}

