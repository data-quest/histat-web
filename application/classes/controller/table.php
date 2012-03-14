<?php

defined('SYSPATH') or die('No direct script access.');

/**
 * Controller <b>Table</b> 
 */
class Controller_Table extends Controller_Data {

    private $sub_navis = array();
    private $id_hs = null;
    private $filter = '________________________________';

    public function before() {

        parent::before();
        $this->sub_navis = array(
            'index' => __('New'),
            'top' => __('Top'),
            'times' => __('Times'),
            'themes' => __('Themes'),
            'names' => __('Names')
        );
        $index = Arr::get($this->session->get('action'), 'name', 'index');
        $this->sub_navi->activate($this->sub_navis[$index]);
        $this->id_hs = $this->request->param('id');
    }

    public function set_filter($filters) {
        if ($filters) {
            foreach ($filters as $filter) {
                if ($filter !== "all") {
                    $filter = explode('_', $filter);
                    $code = $filter[0];
                    $pos = $filter[1];
                    $len = $filter[2];
                    $c = 0;
                    for ($i = 0; $i < strlen($this->filter); $i++) {
                        if ($i == $pos - 1) {
                            for ($l = $i; $l < $pos + $len - 1; $l++) {
                                $this->filter[$l] = $code[$c];
                                $c++;
                            }
                        }
                    }
                }
            }
        }
    }

    public function action_details() {
        $keymask = ORM::factory('keymask', $this->id_hs);
        $this->scripts[] = 'table.js';
        $this->session->set('referrer', $this->request->uri());

        if ($this->user->has_roles(array('guest')))
            $this->request->redirect(I18n::$lang . '/auth/login');

        $view = View::factory(I18n::$lang . '/table/details');
        $list = View::factory(I18n::$lang . '/project/list');
        //assign new projects to subview
        $list->projects = $keymask->project;
        //assign the referrer uri
        $list->uri = URL::site(I18n::$lang . '/table/details/' . $this->id_hs);


        $this->set_filter($this->request->post('filter', NULL));

        $details = $keymask->getDetails($this->filter);
        $data = null;
    
        if( count($details['keys']) <= $this->config->get('max_timelines')){
             $data = $keymask->getData($this->filter);
        }
       // $data = array();
        $view->details = $details['details'];
        $view->keys = $details['keys'];
        $view->data = $data;
        $view->keymask = $keymask;
        $view->tables = $details['tables'];
        $view->titles = $details['titles'];
        $view->filters = $details['filters'];
        $view->post = $this->request->post('filter', NULL);

        $view->project = $list->render();
        $this->content = $view->render();
    }

    public function action_load() {
        
    }

}