<?php

defined('SYSPATH') or die('No direct script access.');

class Controller_Profile extends Controller_Index {

    public function before() {
        parent::before();
        if (!$this->user->has_roles(array('login', 'admin'))) {
            throw new HTTP_Exception_404();
        }
        $this->sub_navi->add('profile', __('Edit info'));
        $this->sub_navi->add('profile/edit_password', __('Change password'));
        $this->layout = View::factory('profile/layout');
        $this->layout->content = '';
    }

    public function action_index() {
        $this->action_edit_info();
    }

    public function action_edit_info() {
        $this->sub_navi->activate(__('Edit info'));
        $view = View::factory(I18n::$lang . '/auth/edit_info');
        $view->errors = array();
       
        $view->user = $this->user;
        if (HTTP_Request::POST == $this->request->method()) {
            try {
                //Add additional values which dont comes from Form
                $additional = array(
                    'chdate' => time(),
                );

                $post = Arr::merge($this->request->post(), $additional);
                // Create the user using form values
               
                $this->user->update_user($post, array(
                    'email',
                    'chdate',
                    'title',
                    'name',
                    'surname',
                    'institution',
                    'department',
                    'street',
                    'zip',
                    'location',
                    'country',
                    'phone',
                    'ip'
                ));
               // Reset values so form is not sticky
                $_POST = array();
                $view->success = TRUE;
            } catch (ORM_Validation_Exception $e) {
                $view->errors = $e->errors(I18n::$lang);
            }
        }
        $this->layout->content = $view->render();
    }

    public function action_edit_password() {
        $this->sub_navi->activate(__('Change password'));
          $view = View::factory(I18n::$lang . '/auth/edit_password');
        $view->errors = array();
       
        $view->user = $this->user;
        if (HTTP_Request::POST == $this->request->method()) {
            try {
                //Add additional values which dont comes from Form
                $additional = array(
                    'chdate' => time(),
                );

                $post = Arr::merge($this->request->post(), $additional);
                // Create the user using form values
               
                $this->user->update_user($post, array(
                    'password',
                    'password_confirm',
                    'password_current'
                ));
               // Reset values so form is not sticky
                $_POST = array();
                $view->success = TRUE;
            } catch (ORM_Validation_Exception $e) {
                $view->errors = $e->errors(I18n::$lang);
            }
        }
        $this->layout->content = $view->render();
    }

    public function after() {
        $this->content = $this->layout->render();
        parent::after();
    }

}

