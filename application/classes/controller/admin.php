<?php

defined('SYSPATH') or die('No direct script access.');

class Controller_Admin extends Controller_Index {

    public function before() {
        parent::before();
        if (!$this->user->has_roles(array('admin')))
            throw new HTTP_Exception_404();
        $this->main_navi->activate(__('Admin'));
        $this->sub_navi->add('admin/users', __('Users'));
        $this->sub_navi->add('admin/logs', __('Logs'));
           $this->sub_navi->add('admin/headlogs', __('Head logs'));
        $this->sub_navi->add('admin/stats', __('Stats'));
    }

    public function action_index() {
      $this->action_users();
    }

    public function action_users() {
         $this->sub_navi->activate(__('Users'));
         $message = $this->request->param('id','');
        $view = View::factory(I18n::$lang.'/admin/user/index');
        $list = View::factory(I18n::$lang.'/admin/user/list');
        
        $users = ORM::factory('user');
        $list->users = $users->find_all();
        $view->list = $list->render();
        $view->dialog = $message;
        $this->content = $view->render();
    }
       public function action_logs() {
         $this->sub_navi->activate(__('Logs'));
        $view = View::factory(I18n::$lang.'/admin/logs/list');
   
        
        $logs = ORM::factory('tablelog');
 
        $view->logs = $logs->find_all();
      
        $this->content = $view->render();
    }
        public function action_headlogs() {
         $this->sub_navi->activate(__('Head logs'));
        $view = View::factory(I18n::$lang.'/admin/logs/headlist');
   
        
        $logs = ORM::factory('tableheadlog');
 
        $view->logs = $logs->find_all();
      
        $this->content = $view->render();
    }
      public function action_stats() {
         $this->sub_navi->activate(__('Stats'));
        $view = View::factory(I18n::$lang.'/admin/stats/list');
   
        
        $logs = ORM::factory('download');
 
        $view->logs = $logs->find_all();
      
        $this->content = $view->render();
    }

}