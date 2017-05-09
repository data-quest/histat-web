<?php

defined('SYSPATH') or die('No direct script access.');

/**
 * Controller <b>Table</b>
 */
class Controller_Download extends Controller_Table {
    private $type;

    public function action_xls() {
        $this->type='xls';
    }

    public function action_xlsx() {
        $this->type = 'xlsx';
    }

    public function action_csv() {
        $this->type = 'csv';
    }

    public function after() {

        $keymask = ORM::factory('keymask', $this->id_hs);

        if ($this->user->has_roles(array('guest')) && $keymask->project->Zugangsklasse == "-1")
        {
            if (Kohana::$environment === Kohana::PRODUCTION)
            {
                $url = 'https://histat.gesis.org/histat/' . I18n::$lang . '/table/' . $this->type . '/' . $this->id_hs . '/' . $this->filter;
            }
            else
            {
                $url = URL::site(I18n::$lang . '/table/' . $this->type . '/' . $this->id_hs . '/' . $this->filter, 'http');
            }

            $this->request->redirect($url);
        }



        $this->action_details();

        $view = View::factory(I18n::$lang . '/download');
        $view->action = $this->request->action();
        $view->id_hs = $this->id_hs;
        $view->filter = $this->filter;
        $view->options = Kohana::$config->load('download')->get('options');
        $this->content .= $view->render();


        parent::after();
    }

}