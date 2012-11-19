<?php

defined('SYSPATH') or die('No direct script access.');

class Controller_Stats extends Controller_Admin {

    private $result = '';
    private $options = array(
        'Übersicht der registrierten Nutzer',
        'Übersicht der einzelnen Downloads (Datentabellen)',
        'Übersicht zur Anzahl der Downloads (Datentabellen) nach Studien',
        'Anzahl der Downloads (Datentabellen) nach Studien und Nutzern',
        'Verwendungszweck der Downloads',
        'Studien ohne Downloads',
        'Übersicht der Downloads nach Themen',
        'Liste der Studien',
        'Gesamtübersicht: Registrierungen, Anmeldungen und Downloads'
    );
    private $name = '';
    private $download = false;

    public function action_index() {
        
    }

    public function action_display() {
        $this->sub_navi->activate(__('Stats'));

        $view = View::factory(I18n::$lang . '/admin/stats/index');
        $view->options = $this->options;
        $content = '';

        if (HTTP_Request::POST == $this->request->method()) {

            $this->download = $this->request->post('download') != NULL;

            $option = $this->request->post('option');
            $from = strtotime($this->request->post('from'));
            $to = strtotime($this->request->post('to'));
            $this->name = __($this->options[$option]);
            $this->{'option_' . $option}($from, $to);
        }
        $view->content = $content;
        $this->content = $view->render();
    }

    private function option_0($from, $to) {

        $users = ORM::factory('user')
                        ->where('mkdate', 'BETWEEN', DB::expr(':from AND :to', array(':from' => $from, ':to' => $to)))
                        ->order_by('mkdate', 'ASC')->find_all();



        if (!$this->download) {
            $view = View::factory(I18n::$lang . '/admin/stats/option_0');
            $view->result = $users;
            $this->result = $view->render();
        } else {
            $view = View::factory(I18n::$lang . '/admin/stats/csv/option_0');
            $view->result = $users;
            $this->response->body(utf8_decode($view->render()))->headers(array('Content-Type' => 'text/csv', 'charset' => 'ISO-8859-1'))->send_file(TRUE, $this->name . '.csv');
        }
    }

    private function option_1($from, $to) {
        $result = DB::select(
                        array('a.ID', 'dl'), array(DB::expr('IFNULL(b.Projektname,a.name)'), 'Studientitel'), array(DB::expr('IFNULL(b.ZA_Studiennummer,a.za_nummer)'), 'za'), array('b.Zugangsklasse', 'klasse'), array('a.intended_use', 'Verwendungszweck'), array('a.mkdate', 'Zeitpunkt'), array(DB::expr("CONCAT_WS(' ', title,  c.surname,c.name)"), 'Name')
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



        if (!$this->download) {
            $view = View::factory(I18n::$lang . '/admin/stats/option_1');
            $view->result = $result;
            $this->result = $view->render();
        }else {
            $view = View::factory(I18n::$lang . '/admin/stats/csv/option_1');
            $view->result = $result;
            $this->response->body(utf8_decode($view->render()))->headers(array('Content-Type' => 'text/csv', 'charset' => 'ISO-8859-1'))->send_file(TRUE, $this->name . '.csv');
        }
    }

    private function option_2($from, $to) {

        $result = DB::select(
                        array(DB::expr('IFNULL(b.Projektname,a.name)'), 'Studientitel'), array(DB::expr('IFNULL(b.ZA_Studiennummer,a.za_nummer)'), 'za'), array(DB::expr('COUNT(a.id)'), 'downloads'), array(DB::expr('SUM(anzahl)'), 'timelines'), array(DB::expr('COUNT(DISTINCT username, TO_DAYS(FROM_UNIXTIME(a.mkdate)))'), 'call_downloads')
                )
                ->from(array('user_downloads', 'a'))
                ->join(array('Aka_Projekte', 'b'), 'LEFT')
                ->on('a.projekt_id', '=', 'b.ID_Projekt ')
                ->where('a.mkdate', 'BETWEEN', DB::expr(':from AND :to', array(':from' => $from, ':to' => $to)))
                ->group_by('za')
                ->order_by('downloads', 'DESC')
                ->as_object()
                ->execute();



        if (!$this->download) {
            $view = View::factory(I18n::$lang . '/admin/stats/option_2');
            $view->result = $result;
            $this->result = $view->render();
        }else {
            $view = View::factory(I18n::$lang . '/admin/stats/csv/option_2');
            $view->result = $result;
            $this->response->body(utf8_decode($view->render()))->headers(array('Content-Type' => 'text/csv', 'charset' => 'ISO-8859-1'))->send_file(TRUE, $this->name . '.csv');
        }
    }

    private function option_3($from, $to) {

        $result = DB::select(
                        array('a.mkdate', 'download_date'), array(DB::expr('IFNULL(b.Projektname,a.name)'), 'Studientitel'), array(DB::expr('IFNULL(b.ZA_Studiennummer,a.za_nummer)'), 'za'), array('b.Zugangsklasse', 'klasse'), array('c.ID', 'user_id'), 'country', 'zip', 'location', 'street', 'email', 'institution', 'department', 'email', array(DB::expr('COUNT(a.id)'), 'downloads'), array(DB::expr("CONCAT_WS(' ', c.surname,c.name)"), 'Name')
                )
                ->from(array('user_downloads', 'a'))
                ->join(array('Aka_Projekte', 'b'), 'LEFT')
                ->on('a.projekt_id', '=', 'b.ID_Projekt ')
                ->join(array('users', 'c'), 'LEFT')
                ->on('a.username', '=', 'c.username')
                ->where('a.mkdate', 'BETWEEN', DB::expr(':from AND :to', array(':from' => $from, ':to' => $to)))
                ->group_by('download_date', 'user_id', 'za')
                ->order_by('a.mkdate')
                ->as_object()
                ->execute();



        if (!$this->download) {
            $view = View::factory(I18n::$lang . '/admin/stats/option_3');
            $view->result = $result;
            $this->result = $view->render();
        }else {
            $view = View::factory(I18n::$lang . '/admin/stats/csv/option_3');
            $view->result = $result;
            $this->response->body(utf8_decode($view->render()))->headers(array('Content-Type' => 'text/csv', 'charset' => 'ISO-8859-1'))->send_file(TRUE, $this->name . '.csv');
        }
    }

    private function option_4($from, $to) {
        $result = DB::select(
                        'intended_use', array(DB::expr('COUNT(anzahl)'), 'downloads'), array(DB::expr('count(distinct(IFNULL(b.ZA_Studiennummer,a.za_nummer)))'), 'projects')
                )
                ->from(array('user_downloads', 'a'))
                ->join(array('Aka_Projekte', 'b'), 'LEFT')
                ->on('a.projekt_id', '=', 'b.ID_Projekt ')
                ->where('a.mkdate', 'BETWEEN', DB::expr(':from AND :to', array(':from' => $from, ':to' => $to)))
                ->group_by('intended_use')
                ->order_by('downloads', 'DESC')
                ->as_object()
                ->execute();



        if (!$this->download) {
            $view = View::factory(I18n::$lang . '/admin/stats/option_4');
            $view->result = $result;
            $this->result = $view->render();
        }else {
            $view = View::factory(I18n::$lang . '/admin/stats/csv/option_4');
            $view->result = $result;
            $this->response->body(utf8_decode($view->render()))->headers(array('Content-Type' => 'text/csv', 'charset' => 'ISO-8859-1'))->send_file(TRUE, $this->name . '.csv');
        }
    }

    private function option_5($from, $to) {

        $result = DB::select(
                        array('b.Projektname', 'title'), array('b.ZA_Studiennummer', 'za')
                )
                ->from(array('user_downloads', 'a'))
                ->join(array('Aka_Projekte', 'b'), 'LEFT')
                ->on('a.projekt_id', '=', DB::expr('b.ID_Projekt AND a.mkdate BETWEEN :from AND :to', array(':from' => $from, ':to' => $to)))
                ->where(DB::expr('1'), DB::expr(''), DB::expr(''))
                ->where('b.ID_Thema', '<>', $this->config->get('example_theme_id'))
                ->where('a.projekt_id', 'IS', DB::expr('NULL'))
                ->group_by('b.ID_Projekt')
                ->order_by('za')
                ->as_object()
                ->execute();



        if (!$this->download) {
            $view = View::factory(I18n::$lang . '/admin/stats/option_5');
            $view->result = $result;
            $this->result = $view->render();
        }else {
            $view = View::factory(I18n::$lang . '/admin/stats/csv/option_5');
            $view->result = $result;
            $this->response->body(utf8_decode($view->render()))->headers(array('Content-Type' => 'text/csv', 'charset' => 'ISO-8859-1'))->send_file(TRUE, $this->name . '.csv');
        }
    }

    private function option_6($from, $to) {

        $result = DB::select(
                        array('c.Thema', 'theme'), array(DB::expr('COUNT(a.id)'), 'downloads'), array(DB::expr('COUNT(DISTINCT IFNULL(b.ZA_Studiennummer,a.za_nummer),TO_DAYS(FROM_UNIXTIME(a.mkdate))) '), 'download_projects'), array(DB::expr('COUNT(DISTINCT IFNULL(b.ZA_Studiennummer,a.za_nummer) )'), 'download_different_projects')
                )
                ->from(array('user_downloads', 'a'))
                ->join(array('Aka_Projekte', 'b'), 'LEFT')
                ->on('a.projekt_id', '=', 'b.ID_Projekt ')
                ->join(array('Aka_Themen', 'c'), 'LEFT')
                ->on('b.ID_Thema', '=', 'c.ID_Thema')
                ->where('a.mkdate', 'BETWEEN', DB::expr(':from AND :to', array(':from' => $from, ':to' => $to)))
                ->group_by('c.ID_Thema')
                ->order_by('downloads', 'DESC')
                ->as_object()
                ->execute();



        if (!$this->download) {
            $view = View::factory(I18n::$lang . '/admin/stats/option_6');
            $view->result = $result;
            $this->result = $view->render();
        }else {
            $view = View::factory(I18n::$lang . '/admin/stats/csv/option_6');
            $view->result = $result;
            $this->response->body(utf8_decode($view->render()))->headers(array('Content-Type' => 'text/csv', 'charset' => 'ISO-8859-1'))->send_file(TRUE, $this->name . '.csv');
        }
    }

    private function option_7($from, $to) {

        $result = DB::select(
                        array('ZA_Studiennummer', 'za'), array('Projektname', 'title'), array('Projektautor', 'author')
                )
                ->from('Aka_Projekte')
                ->where('ID_Thema', '<>', $this->config->get('example_theme_id'))
                ->order_by('ZA_Studiennummer', 'DESC')
                ->as_object()
                ->execute();

        if (!$this->download) {
            $view = View::factory(I18n::$lang . '/admin/stats/option_7');
            $view->result = $result;
            $this->result = $view->render();
        }else {
            $view = View::factory(I18n::$lang . '/admin/stats/csv/option_7');
            $view->result = $result;
            $this->response->body(utf8_decode($view->render()))->headers(array('Content-Type' => 'text/csv', 'charset' => 'ISO-8859-1'))->send_file(TRUE, $this->name . '.csv');
        }
    }

    private function option_8($from, $to) {


        $quest_id = ORM::factory('role', array('name' => 'guest'))->users->find()->id;
        $result = array();
        $result[] = DB::select(array(DB::expr("COUNT(*)"), 'count'))
                ->from('users')
                ->where('mkdate', 'BETWEEN', DB::expr(':from AND :to', array(':from' => $from, ':to' => $to)))
                ->as_object()
                ->execute();
        $result[] = DB::select(array(DB::expr("COUNT(*)"), 'count'))
                ->from('users')
                ->where('institution', '!=', "")
                ->where('mkdate', 'BETWEEN', DB::expr(':from AND :to', array(':from' => $from, ':to' => $to)))
                ->as_object()
                ->execute();
        $result[] = DB::select(array(DB::expr("COUNT(*)"), 'count'))
                ->from('users')
                ->or_where_open()
                ->where('institution', '=', "")
                ->or_where('institution', 'IS', DB::expr("NULL"))
                ->or_where_close()
                ->where('mkdate', 'BETWEEN', DB::expr(':from AND :to', array(':from' => $from, ':to' => $to)))
                ->as_object()
                ->execute();
        $result[] = DB::select(array(DB::expr("COUNT(*)"), 'count'))
                ->from('user_logins')
                ->where('mkdate', 'BETWEEN', DB::expr(':from AND :to', array(':from' => $from, ':to' => $to)))
                ->as_object()
                ->execute();
        $result[] = DB::select(array(DB::expr("COUNT(*)"), 'count'))
                ->from('user_logins')
                ->where('user_id', '=', $quest_id)
                ->where('mkdate', 'BETWEEN', DB::expr(':from AND :to', array(':from' => $from, ':to' => $to)))
                ->as_object()
                ->execute();
        $result[] = DB::select(array(DB::expr("COUNT(DISTINCT b.username)"), 'count'))
                ->from(array('user_logins', 'a'))
                ->join(array('users', 'u'), 'INNER')
                ->on('a.user_id', '=', 'u.id')
                ->join(array('user_downloads', 'b'), 'INNER')
                ->on('u.username', '=', 'b.username')
                ->where('a.mkdate', 'BETWEEN', DB::expr(':from AND :to', array(':from' => $from, ':to' => $to)))
                ->as_object()
                ->execute();
        $result[] = DB::select(array(DB::expr("COUNT(*)"), 'count'))
                ->from(array('user_logins', 'a'))
                ->join(array('users', 'u'), 'INNER')
                ->on('a.user_id', '=', 'u.id')
                ->join(array('user_downloads', 'b'), 'INNER')
                ->on('u.username', '=', 'b.username')
                ->where('a.mkdate', 'BETWEEN', DB::expr(':from AND :to', array(':from' => $from, ':to' => $to)))
                ->as_object()
                ->execute();
        $result[] = DB::select(array(DB::expr("SUM(anzahl)"), 'count'))
                ->from('user_downloads')
                ->where('mkdate', 'BETWEEN', DB::expr(':from AND :to', array(':from' => $from, ':to' => $to)))
                ->as_object()
                ->execute();
        $result[] = DB::select(array(DB::expr("COUNT(*)"), 'count'))
                ->from('user_downloads')
                ->where('mkdate', 'BETWEEN', DB::expr(':from AND :to', array(':from' => $from, ':to' => $to)))
                ->as_object()
                ->execute();
        $result[] = DB::select(array(DB::expr("COUNT(DISTINCT(IFNULL(b.ZA_Studiennummer,a.za_nummer)))"), 'count'))
                ->from(array('user_downloads', 'a'))
                ->join(array('Aka_Projekte', 'b'), 'LEFT')
                ->on('a.projekt_id', '=', 'b.ID_Projekt')
                ->where('a.mkdate', 'BETWEEN', DB::expr(':from AND :to', array(':from' => $from, ':to' => $to)))
                ->as_object()
                ->execute();
        $result[] = DB::select(array(DB::expr("COUNT(DISTINCT IFNULL(b.ZA_Studiennummer,a.za_nummer),TO_DAYS(FROM_UNIXTIME(a.mkdate)))"), 'count'))
                ->from(array('user_downloads', 'a'))
                ->join(array('Aka_Projekte', 'b'), 'LEFT')
                ->on('a.projekt_id', '=', 'b.ID_Projekt')
                ->where('a.mkdate', 'BETWEEN', DB::expr(':from AND :to', array(':from' => $from, ':to' => $to)))
                ->as_object()
                ->execute();

        if (!$this->download) {
            $view = View::factory(I18n::$lang . '/admin/stats/option_8');
            $view->result = $result;
            $this->result = $view->render();
        }else {
            $view = View::factory(I18n::$lang . '/admin/stats/csv/option_8');
            $view->result = $result;
            $this->response->body(utf8_decode($view->render()))->headers(array('Content-Type' => 'text/csv', 'charset' => 'ISO-8859-1'))->send_file(TRUE, $this->name . '.csv');
        }
    }

   
    public function after() {
        $this->sub_navi->activate(__('Stats'));
        $this->scripts[] = 'stats.js';
        $view = View::factory(I18n::$lang . '/admin/stats/index');
        $view->options = $this->options;
        $view->content = $this->result;
        $this->content = $view->render();
        parent::after();
    }

}