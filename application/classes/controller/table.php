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
        $this->session->set('referrer', $this->request->uri());
        if ($this->user->has_roles(array('guest')))
            $this->request->redirect(I18n::$lang . '/auth/login');
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




        $view = View::factory(I18n::$lang . '/table/details');
        $list = View::factory(I18n::$lang . '/project/list');
        //assign new projects to subview
        $list->projects = $keymask->project;
        //assign the referrer uri
        $list->uri = URL::site(I18n::$lang . '/table/details/' . $this->id_hs);


        $this->set_filter($this->request->post('filter', NULL));

        $details = $keymask->getDetails($this->filter);
        $data = null;

        if (count(Arr::get($details, 'keys', array())) <= $this->config->get('max_timelines')) {
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
        $view->sources = $details['sources'];
        $view->notes = $details['notes'];
        $view->filter = $this->filter;
        $view->post = $this->request->post('filter', NULL);

        $view->project = $list->render();
        $this->content = $view->render();
    }

    public function action_xls() {
        $param = explode('/', $this->request->param('id'));
        $this->id_hs = $param[0];
        $this->filter = $param[1];
       // $this->auto_render = FALSE;

        $keymask = ORM::factory('keymask', $this->id_hs);
        $details = $keymask->getDetails($this->filter);
        $details['data'] = null;

        if (count(Arr::get($details, 'keys', array())) <= $this->config->get('max_timelines')) {
            $details['data'] = $keymask->getData($this->filter);
        }
        if ($details['data']) {
            $grid = $this->create_grid($details);
            $grid[1] = array($keymask->Name);
            $ws = new Spreadsheet();
            $ws->set_active_sheet(0);
            $ws->set_data($grid);
            $ws->send(array('name' => ($keymask->Name), 'format' => 'Excel5'));
        }
    }
     public function action_xlsx() {
        $param = explode('/', $this->request->param('id'));
        $this->id_hs = $param[0];
        $this->filter = $param[1];
       // $this->auto_render = FALSE;

        $keymask = ORM::factory('keymask', $this->id_hs);
        $details = $keymask->getDetails($this->filter);
        $details['data'] = null;

        if (count(Arr::get($details, 'keys', array())) <= $this->config->get('max_timelines')) {
            $details['data'] = $keymask->getData($this->filter);
        }
        if ($details['data']) {
            $grid = $this->create_grid($details);
            $grid[1] = array($keymask->Name);
            $ws = new Spreadsheet();
            $ws->set_active_sheet(0);
            $ws->set_data($grid);
            $ws->send(array('name' => ($keymask->Name), 'format' => 'Excel2007'));
        }
    }
    public function action_csv() {
        $param = explode('/', $this->request->param('id'));
        $this->id_hs = $param[0];
        $this->filter = $param[1];
        $this->auto_render = FALSE;

        $keymask = ORM::factory('keymask', $this->id_hs);
        $details = $keymask->getDetails($this->filter);
        $details['data'] = null;

        if (count(Arr::get($details, 'keys', array())) <= $this->config->get('max_timelines')) {
            $details['data'] = $keymask->getData($this->filter);
        }
        if ($details['data']) {
            $grid = $this->create_grid($details);
            $grid[1] = array($keymask->Name);
            $ws = new Spreadsheet();
            $ws->set_active_sheet(0);
            $ws->set_data($grid);
            $ws->send(array('name' => $keymask->Name, 'format' => 'CSV'));
        }
    }

    private function create_grid($details) {
        $grid = array();
        $i = 2;
        $headers = Arr::get($details, 'details', array());
        $tables = Arr::get($details, 'tables', array());
        $sources = Arr::get($details, 'sources', array());
        $data = Arr::get($details, 'data', array());
        $keys = Arr::get($details, 'keys', array());
         $notes = Arr::get($details, 'notes', array());
        foreach ($headers as $header) {
            $row = array();
            $key = array_keys($header);
            $row[] = $header[$key[0]]->CodeBeschreibung;
            foreach ($keys as $k) {
                $row[] = $header[$k]->CodeBezeichnung;
            }
            $grid[$i] = $row;
            $i++;
        }
        if (count(array_filter($tables)) > 0) {
            $row = array();
            $row[] = 'Tabelle';
            foreach ($keys as $k) {
                $row[] = str_replace(array("\r\n", "\n", "\r"), ' ', $tables[$k]);
            }
            $grid[$i] = $row;
            $i++;
        }
        if (count(array_filter($sources)) > 0) {
            $row = array();
            $row[] = 'Quellen';
            foreach ($keys as $k) {
                $row[] = str_replace(array("\r\n", "\n", "\r"), ' ', $sources[$k]);
            }
            $grid[$i] = $row;
            $i++;
        }
       if (count(array_filter($notes)) > 0) {
            $row = array();
            $row[] = 'Anmerkungen';
            foreach ($keys as $k) {
                $row[] = str_replace(array("\r\n", "\n", "\r"), ' ', $notes[$k]);
            }
            $grid[$i] = $row;
            $i++;
        }
        foreach ($data as $y => $d) {
            $row = array();
            $row[] = $y;

            foreach ($keys as $k) {
                $newData =  Arr::get($d, $k, array('data'=>'','note'=>NULL));
                if(Arr::get($newData,'note')){
                  $row[] = $newData;  
                }else{
                    $row[] = Arr::get($newData,'data');
                }
                
            }
            $grid[$i] = $row;
            $i++;
        }
        return $grid;
    }

}