<?php

defined('SYSPATH') or die('No direct script access.');

class Controller_Cart extends Controller_Table {

    public function before() {
        parent::before();
        $this->sub_navi->activate();
    }

    public function action_index() {
        $view = View::factory(I18n::$lang . '/cart/index');


        $filters = array();
        $projects = array();
        $tables = array();
        foreach ($this->user->cart_items->find_all() as $item) {
            $keymask = $item->keymask;
            $projectID = $keymask->project->ID_Projekt;
            $bearbeitung = '';
            $datum = substr($keymask->project->Datum_der_Bearbeitung, -4);
            if (!empty($datum)) {
                $bearbeitung = '[' . $datum . ']';
            }

            $projectName = __(':author, (:pub_year :edit_year) :project', array(':author' => $keymask->project->Projektautor,
                ':pub_year' => $keymask->project->Publikationsjahr,
                ':edit_year' => $bearbeitung,
                ':project' => $keymask->project->Projektname
                    ));


            $tableID = $item->ID_HS;
            $tableName = $keymask->Name;
            $filter = $item->filter;
            $filterText = json_decode($item->filter_text);
            $filters[$projectID][$tableID][$filter] = array('text' => $filterText, 'timelines' => $item->timelines);
            $projects[$projectID] = array('name' => $projectName,
                'za' => $keymask->project->ZA_Studiennummer,
                'theme' => $keymask->project->theme->Thema
            );

            $tables[$projectID][$tableID] = $tableName;
        }
        $view->message = $this->request->param('id', FALSE);
        $view->projects = $projects;
        $view->tables = $tables;
        $view->filters = $filters;
        $this->content = $view->render();
    }

    public function action_delete() {

        $cart = ORM::factory('cart')
                ->where('user_id', '=', $this->user->id)
                ->where('ID_HS', '=', $this->id_hs)
                ->where('filter', '=', $this->filter)
                ->find();
        if ($cart->loaded()) {
            $cart->delete();
            $this->request->redirect(I18n::$lang . '/cart/index/success');
        }
        $this->request->redirect(I18n::$lang . '/cart/index/error');
    }

    public function action_delete_selected() {
        $result = DB::delete('warenkorb')
                ->where('user_id', '=', $this->user->id)
                ->where(DB::expr('CONCAT_WS("/",ID_HS,filter)'), 'IN', DB::expr("('" . implode("','", $this->request->post('selected')) . "')"))
                ->execute();


        if ($result) {

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

    public function action_download_selected() {

        if (HTTP_Request::POST != $this->request->method() || $this->request->post('selected') == NULL) {
            $this->request->redirect(I18n::$lang . '/cart/index');
        }
        $cart = ORM::factory('cart')
                ->where('user_id', '=', $this->user->id)
                ->where(DB::expr('CONCAT_WS("/",ID_HS,filter)'), 'IN', DB::expr("('" . implode("','", $this->request->post('selected')) . "')"))
                ->find_all();
        $formats = array(
            'xsl' => 'Excel5',
            'xslx' => 'Excel2007',
            'csv' => 'CSV'
        );
        if (!is_dir('/tmp/histat/')) {
            mkdir('/tmp/histat/', 0777, true);
        }
        if (!is_dir('/tmp/histat/download_' . $this->user->id)) {
            mkdir('/tmp/histat/download_' . $this->user->id);
        }
        if (file_exists('/tmp/histat/download_' . $this->user->id . '.zip')) {
            unlink('/tmp/histat/download_' . $this->user->id . '.zip');
        }

        foreach ($cart as $nr => $item) {

            $keymask = ORM::factory('keymask', $item->ID_HS);
            $details = $keymask->getDetails($item->filter);
            $details['data'] = null;
            $names = array();
            if (count(Arr::get($details, 'keys', array())) <= $this->config->get('max_timelines')) {
                $details['data'] = $keymask->getData($item->filter);
            }
            if ($details['data']) {
                $grid = $this->create_grid($details);
                $grid[1] = array($keymask->Name);
                $ws = new Spreadsheet();
                $ws->set_active_sheet(0);
                $ws->set_data($grid);
                $name = $ws->save(array('name' => ($keymask->Name . '-' . $nr), 'format' => Arr::get($formats, $this->request->post('format'), 'Excel2007'), 'path' => '/tmp/histat/download_' . $this->user->id . '/'));


         
            }
        }
        $path = '/tmp/histat/';


        $command = sprintf("cd /tmp/histat/ ;zip -r download_%d.zip  download_%d/", $this->user->id, $this->user->id);

        exec($command);

        $this->rrmdir('/tmp/histat/download_' . $this->user->id . '/');


        $this->response->send_file('/tmp/histat/download_' . $this->user->id . '.zip',sprintf("Warenkorb_%s.zip",date("m-d-y-h-i",time())));
       
    }

    private function rrmdir($dir) {
        $fp = opendir($dir);
        if ($fp) {
            while ($f = readdir($fp)) {
                $file = $dir . "/" . $f;
                if ($f == "." || $f == "..") {
                    continue;
                } else if (is_dir($file) && !is_link($file)) {
                    rrmdir($file);
                } else {
                    unlink($file);
                }
            }
            closedir($fp);
            rmdir($dir);
        }
    }

}

