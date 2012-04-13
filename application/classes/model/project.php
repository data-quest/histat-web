<?php

defined('SYSPATH') or die('No direct access allowed.');

class Model_Project extends ORM {

    protected $_table_name = 'Aka_Projekte';
    protected $_primary_key = 'ID_Projekt';
    protected $_has_many = array(
        'keymasks' => array('model' => 'keymask', 'foreign_key' => 'ID_Projekt', 'far_key' => 'ID_Projekt'),
    );
    protected $_has_one = array(
        'theme' => array('model' => 'theme', 'foreign_key' => 'ID_Thema', 'far_key' => 'ID_Thema'),
        'time' => array('model' => 'theme', 'foreign_key' => 'ID_Zeit', 'far_key' => 'ID_Zeit')
    );
    protected $_belongs_to = array(
        'theme' => array('model' => 'theme', 'foreign_key' => 'ID_Thema', 'far_key' => 'ID_Thema'),
        'time' => array('model' => 'theme', 'foreign_key' => 'ID_Zeit', 'far_key' => 'ID_Zeit')
    );
    protected $_table_columns = array(
        'ID_Projekt' => array(),
        'ID_Thema' => array(),
        'ID_Zeit' => array(),
        'Projektautor' => array(),
        'Projektname' => array(),
        'Projektbeschreibung' => array(),
        'Veroeffentlichung' => array(),
        'Untersuchsungsgebiet' => array(),
        'Quellen' => array(),
        'Untergliederung' => array(),
        'ZA_Studiennummer' => array(),
        'Datum_der_Archivierung' => array(),
        'Datum_de_Bearbeitung' => array(),
        'Bearbeiter_im_ZA' => array(),
        'Bemerkungen' => array(),
        'Zugangsklasse' => array(),
        'Anzahl_Zeitreiehen' => array(),
        'Zeitraum' => array(),
        'exportable' => array(),
        'Fundort' => array(),
        'Anmerkungsteil' => array(),
        'datei_inhalt' => array(),
        'datei_name' => array(),
        'chdate' => array()
    );

    public function new_projects() {

        return $this->select(
                                array('ZA_Studiennummer', 'Studiennummer'), array('Projektname', 'Studientitel'), array('Projektautor', 'Autor'), 'ID_Projekt'
                        )
                        ->where('ID_Thema', '!=', Kohana::$config->load('config.example_theme_id'))
                        ->order_by('chdate', 'DESC')
                        ->limit('30');
    }

    public function getUsedTables() {
        return DB::select("lz.ID_HS")->distinct(true)
                        ->from(array("Aka_Projekte", "p"))
                        ->join(array('Aka_Schluesselmaske', 'sm'), 'INNER')->on('p.ID_Projekt', '=', 'sm.ID_Projekt')
                        ->join(array('Lit_ZR', 'lz'), 'INNER')->on('sm.ID_HS', '=', 'lz.ID_HS')
                        ->where('p.ID_Projekt', '=', $this->ID_Projekt)
                        ->order_by('lz.ID_HS')->as_object()->execute();
    }

    public function getAuthors() {

        return DB::select('ID_Projekt', 'Projektautor')
                        ->from(array('Aka_Projekte', 'p'))
                        ->where('p.ID_Thema', '!=', Kohana::$config->load('config.example_theme_id'))
                        ->where('p.Projektautor', 'IS NOT', NULL)
                        ->as_object()
                        ->execute();
    }

    public function search($post = NULL) {

        $theme = Arr::get($post, 'theme');
        if ($theme === '-1')
            $theme = null;

        $text = Arr::get($post, 'text', '');
        $title = Arr::get($post, 'title', NULL);
        $source = Arr::get($post, 'source', NULL);
        $description = Arr::get($post, 'description', NULL);
        $min = Arr::get($post, 'min', 0);
        $max = Arr::get($post, 'max', 0);
        $result = array();
        if ($title) {
            $db = DB::select('p.ID_Projekt')
                    ->distinct(TRUE)
                    ->from(array('Aka_Projekte', 'p'))
                    ->join(array('aka_schluesselindex','asx'),'INNER')
                    ->using('ID_Projekt')
                    ->where('asx.min_jahr_sem','>=',$min)
                    ->where('asx.max_jahr_sem','<=',$max);
            if ($theme) {
                $db->where('p.ID_Thema', '=', $theme);
            } else {
                $db->where('p.ID_Thema', '!=', Kohana::$config->load('config.example_theme_id'));
            }
            $db->where(DB::expr("MATCH(Projektname, Projektbeschreibung, Anmerkungsteil, Untergliederung)"), ' ', DB::expr("AGAINST('" . $text . "' IN BOOLEAN MODE)"));
           
            foreach($db->as_object()->execute() as $value){
                $result[$value->ID_Projekt] = $value->ID_Projekt;
            }
        }
        
        if ($source) {
            $db = DB::select('p.ID_Projekt')
                    ->distinct(TRUE)
                    ->from(array('Aka_Projekte', 'p'))
                    ->join(array('aka_schluesselindex','asx'),'INNER')
                    ->using('ID_Projekt')
                    ->join(array('Lit_ZR','lz'))
                    ->using('ID_HS','Schluessel')
                    ->where('asx.min_jahr_sem','>=',$min)
                    ->where('asx.max_jahr_sem','<=',$max);
            if ($theme) {
                $db->where('p.ID_Thema', '=', $theme);
            } else {
                $db->where('p.ID_Thema', '!=', Kohana::$config->load('config.example_theme_id'));
            }
            $db->where(DB::expr("MATCH(Quelle)"), ' ', DB::expr("AGAINST('" . $text . "' IN BOOLEAN MODE)"));
            foreach($db->as_object()->execute() as $value){
                $result[$value->ID_Projekt] = $value->ID_Projekt;
            }
        }
        
           if ($description) {
            $db = DB::select('p.ID_Projekt')
                    ->distinct(TRUE)
                    ->from(array('Aka_Projekte', 'p'))
                    ->join(array('aka_schluesselindex','asx'),'INNER')
                    ->using('ID_Projekt')
                    ->where('asx.min_jahr_sem','>=',$min)
                    ->where('asx.max_jahr_sem','<=',$max);
            if ($theme) {
                $db->where('p.ID_Thema', '=', $theme);
            } else {
                $db->where('p.ID_Thema', '!=', Kohana::$config->load('config.example_theme_id'));
            }
            $db->where(DB::expr("MATCH(schluessel_index,hs_name)"), ' ', DB::expr("AGAINST('" . $text . "' IN BOOLEAN MODE)"));
            foreach($db->as_object()->execute() as $value){
                $result[$value->ID_Projekt] = $value->ID_Projekt;
            }
        }
     
        return $result;
    }

}