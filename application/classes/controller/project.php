<?php

defined('SYSPATH') or die('No direct script access.');

/**
 * Controller <b>Project</b>  has methods for project URI
 */
class Controller_Project extends Controller_Data {

    private $id;
    private $token;

    public function before() {
        $this->auto_render = !$this->request->is_ajax();
        parent::before();
        $this->id = $this->request->param('id', $this->request->post('id'));
        $this->token = $this->request->post('xsrf');
        $this->session->set('referrer', NULL);
    }

    public function action_details() {
        if ($this->id == NULL)
            throw new HTTP_Exception_404(); //If ID not given throw Exception
        $this->scripts[] = 'project_details_dialog.js';
        $project = ORM::factory('project', $this->id);
        if ($project->loaded()) {
            $view = View::factory(I18n::$lang . '/project/details');
            $view->project = $project;
            $content = $view->render();
        } else {
            $content = __('Project not found');
        }

        $this->dialog = $content;
    }

    public function action_tables() {
        if ($this->id == NULL)
            throw new HTTP_Exception_404(); //If ID not given throw Exception
        $this->scripts[] = 'project_details_dialog.js';
        $project = ORM::factory('project', $this->id);
        if ($project->loaded()) {
            $view = View::factory(I18n::$lang . '/project/tables');
            $view->project = $project;
            $content = $view->render();
        } else {
            $content = __('Project not found');
        }

        $this->dialog = $content;
    }

    public function action_timeline() {
        if ($this->id == NULL)
            throw new HTTP_Exception_404(); //If ID not given throw Exception

        $this->session->set('referrer', $this->request->uri());

        if ($this->user->has_roles(array('guest')))
            $this->request->redirect(I18n::$lang . '/auth/login');

        $this->scripts[] = 'project_timeline_dialog.js';
        $project = ORM::factory('project', $this->id);
        if ($project->loaded()) {
            $view = View::factory(I18n::$lang . '/project/timeline');
            $view->project = $project;
            $view->names = $project->keymasks->find_all();
            $content = $view->render();
        } else {
            $content = __('Project not found');
        }
        $this->dialog = $content;
    }

    public function action_download() {
        if (!$this->id)
            throw new HTTP_Exception_404(); //If ID not given throw Exception

        $project = ORM::factory('project', $this->id);
        if ($project->loaded() && !empty($project->datei_name)) {
            $this->response->body($project->datei_inhalt)->send_file(TRUE, $project->datei_name);
        }
    }

    public function after() {
        $action = $this->session->get('action');
        $param = Arr::get($action, 'param');
        $action = 'action_' . $action['name'];

        parent::$action($param);
        parent::after();
    }

}

