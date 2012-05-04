<?php

defined('SYSPATH') or die('No direct script access.');

class Controller_Cart extends Controller_Table {

    public function before() {
        parent::before();
    }

    public function action_index() {
        $view = View::factory(I18n::$lang . '/cart/index');


        $filters = array();
        $projects = array();
        $tables = array();
        foreach ($this->user->cart_items->find_all() as $item) {
            $keymask = $item->keymask;
            $projectID = $keymask->project->ID_Projekt;
            $projectName = $keymask->project->Projektname;
            $tableID = $item->ID_HS;
            $tableName = $keymask->Name;
            $filter = $item->filter;
            $filterText = json_decode($item->filter_text);
            $filters[$projectID][$tableID][$filter] = array('text'=>$filterText,'timelines'=>$item->timelines);
            $projects[$projectID] = array('name'=>$projectName,
                    'za'=>$keymask->project->ZA_Studiennummer,
                    'theme'=>$keymask->project->theme->Thema
                    );
            
            $tables[$projectID][$tableID] = $tableName;
        }
        $view->message = $this->request->param('id',FALSE);
        $view->projects = $projects;
        $view->tables = $tables;
        $view->filters = $filters;
        $this->content = $view->render();
    }

    public function action_delete() {
        echo $this->id_hs;
        $cart = ORM::factory('cart')
                ->where('user_id','=',$this->user->id)
                ->where('ID_HS', '=', $this->id_hs)
                ->where('filter', '=', $this->filter)
                ->find();
        if ($cart->loaded()) {
            $cart->delete();
            $this->request->redirect(I18n::$lang . '/cart/index/success');
        }
      $this->request->redirect(I18n::$lang . '/cart/index/error');
    }

    public function action_add() {
        if (HTTP_Request::POST != $this->request->method() && !$this->request->is_ajax() && $this->request->is_initial()) {
            throw new HTTP_Exception_404();
        }
        $this->auto_render = FALSE;
        $this->id_hs = $this->request->post('id');
        $this->filter = $this->request->post('filter');
        
        $filter_text = json_encode($this->request->post('filter_text'));

        $cart = $this->user->cart_items
                ->where('ID_HS', '=', $this->id_hs)
                ->where('filter', '=', $this->filter)
                ->find_all();

        if ($cart->count() == 0) {
            $cart = ORM::factory('cart');
            $cart->ID_HS = $this->id_hs;
            $cart->filter = $this->filter;
            $cart->timelines = $this->request->post('timelines');
            $cart->filter_text = $filter_text;
            $cart->user_id = $this->user->id;
            $cart->chdate = time();
            $cart->create();
            echo true;
        }
        echo false;
        //  $this->request->redirect(I18n::$lang . '/table/details/' . $this->id_hs . '/' . $this->filter);
    }

}

