<?php

defined('SYSPATH') or die('No direct script access.');

/**
 * Controller <b>Table</b> 
 */
class Controller_Table extends Controller_Data {

    private $sub_navis = array();
    private $id_hs = null;

    public function before() {
       
        parent::before();
        $this->sub_navis = array(
            'index' => __('New'),
            'top' => __('Top'),
            'times' => __('Times'),
            'themes' => __('Themes'),
            'authors' => __('Authors')
        );
        $index = Arr::get($this->session->get('action'), 'name', 'index');
        $this->sub_navi->activate($this->sub_navis[$index]);
        $this->id_hs = $this->request->param('id');
        
         if($this->user->has_roles(array('guest')))
            $this->request->redirect(I18n::$lang.'/auth/login');
    }

    public function action_details() {
        $keymask = ORM::factory('keymask', $this->id_hs);
        $this->scripts[] = 'table.js';
        $view = View::factory(I18n::$lang . '/table/details');
        $list = View::factory(I18n::$lang . '/project/list');
        //assign new projects to subview
        $list->projects = $keymask->project;
        //assign the referrer uri
        $list->uri = URL::site(I18n::$lang . '/table/details/' . $this->id_hs);
        $details = array();
        $titels = array();
        foreach ($keymask->getDetails() as $detail) {
            $details[$detail->CodeBeschreibung][$detail->Schluessel] = $detail;
            $titels [$detail->Schluessel][]=$detail->CodeBezeichnung;
            $keys [$detail->Schluessel] = $detail->Schluessel;
        }
       
        $data = $keymask->getData($keys);

         
        $view->id_hs = $this->id_hs;
        $view->details = $details;
        $view->keys = $keys;
        $view->data = $data;
        $view->keymask = $keymask;
        $view->titles = $titels;
        


        $view->project = $list->render();
        $this->content = $view->render();
    }

}