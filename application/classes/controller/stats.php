<?php

defined('SYSPATH') or die('No direct script access.');

class Controller_Stats extends Controller_Admin {

    private $result = '';

    public function action_index() {
        
    }

    public function action_display() {
        $this->sub_navi->activate(__('Stats'));
        $this->scripts[] = 'stats.js';
        $view = View::factory(I18n::$lang . '/admin/stats/index');
        $content = '';

        if (HTTP_Request::POST == $this->request->method()) {
            $option = $this->request->post('option');
            $from = strtotime($this->request->post('from'));
            $to = strtotime($this->request->post('to'));
            $this->{'option_' . $option}($from, $to);
        }
        $view->content = $content;
        $this->content = $view->render();
    }
      private function option_0($from, $to) {
       /*   "SELECT ID as `Nutzer ID` ,username as Nutzername, CONCAT_WS( ' ', titel, vorname, nachname ) AS Name,
									institution as Institution, abteilung as Abteilung , strasse as Strasse, plz as PLZ , ort as Ort , land as Land,
									telefon as Telefon, email as Email, 
									DATE_FORMAT( FROM_UNIXTIME( mkdate ) , '%e.%c.%Y' ) AS `Registriert am`
									FROM auth_user a ",
									'group' => ' ORDER BY mkdate ASC',*/

          $users = ORM::factory('user')
                  ->where('mkdate', 'BETWEEN', DB::expr(':from AND :to', array(':from' => $from, ':to' => $to)))
                  ->order_by('mkdate', 'ASC');
              
     
        $view = View::factory(I18n::$lang . '/admin/stats/option_0');
        $view->result = $users->find_all();
        $this->result = $view->render();
    }
    private function option_1($from, $to) {
      $result = DB::select(
                    array('a.ID', 'dl'), 
                    array(DB::expr('IFNULL(b.Projektname,a.name)'), 'Studientitel'), 
                    array(DB::expr('IFNULL(b.ZA_Studiennummer,a.za_nummer)'),'za'),
                    array('b.Zugangsklasse','klasse'),
                    array('a.intended_use','Verwendungszweck'),
                    array('a.mkdate','Zeitpunkt'),
                    array(DB::expr("CONCAT_WS(' ', title, c.name, c.surname)"),'Name')
                )
                ->from(array('user_downloads', 'a'))
                ->join(array('Aka_Projekte', 'b'), 'LEFT')
                ->on('a.projekt_id', '=', 'b.ID_Projekt ')
                ->join(array('users', 'c'), 'LEFT')
                ->on('a.username', '=', 'c.username')
                ->where('a.mkdate', 'BETWEEN', DB::expr(':from AND :to', array(':from' => $from, ':to' => $to)))
                ->order_by('a.mkdate')
                ->as_object()
                ->execute();
        
     
        $view = View::factory(I18n::$lang . '/admin/stats/option_1');
        $view->result = $result;
        $this->result = $view->render();
    }

    public function after() {
        $this->sub_navi->activate(__('Stats'));
        $this->scripts[] = 'stats.js';
        $view = View::factory(I18n::$lang . '/admin/stats/index');
        $view->content = $this->result;
        $this->content = $view->render();
        parent::after();
    }

}