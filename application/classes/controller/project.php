<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Controller <b>Project</b>  has methods for project URI
 */
class Controller_Project extends Controller_Data {

    private $id = null;

    public function before() {
        parent::before();
        $this->id = $this->request->param('id');
    }

    public function action_details() {

        if ($this->id == NULL)
            throw new HTTP_Exception_404(); //If ID not given throw Exception
        $project = ORM::factory('project', $this->id);
        if ($project->loaded()) {
            $this->content = '<pre>' . print_r($project->object(), true) . '<pre>';
        } else {
            $this->content = __('Project not found');
        }
    }

}

