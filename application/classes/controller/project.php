<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Controller <b>Project</b>  has methods for project URI
 */
class Controller_Project extends Controller_Data {

    private $id;

    public function before() {
        parent::before();
        $this->id = $this->request->param('id');
    }

    public function action_details() {

        if ($this->id == NULL)
            throw new HTTP_Exception_404(); //If ID not given throw Exception
        $this->sub_navi->activate(__('New'));
        $project = ORM::factory('project', $this->id);
        if ($project->loaded()) {
            $view = View::factory(I18n::$lang . '/project/details');
            $view->project = $project;
            $this->content = $view->render();
        } else {
            $this->content = __('Project not found');
        }
    }

}

