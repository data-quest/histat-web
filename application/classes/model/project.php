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
     
 
      
        $db = DB::select('p.ID_Projekt', 'p.Projektname', 'p.Projektbeschreibung', 'p.Anmerkungsteil', 'p.Untergliederung')
                ->from(array('Aka_Projekte', 'p'));
        if ($theme) {
            $db->where('p.ID_Thema', '=', $theme);
        } else {
            $db->where('p.ID_Thema', '!=', Kohana::$config->load('config.example_theme_id'));
        }



        $db->where(DB::expr("MATCH(Projektname, Projektbeschreibung, Anmerkungsteil, Untergliederung)"), ' ', DB::expr("AGAINST('" . Arr::get($post, 'text', '') . "' IN BOOLEAN MODE)"))
              ;

        //echo '<pre>'.print_r($db->execute(),true).'</pre>';
        //echo Debug::vars($data);
       // echo Debug::vars($post);

        /*
         * SELECT ID_Projekt, Projektname, Projektbeschreibung, Anmerkungsteil, Untergliederung FROM Aka_Projekte
          WHERE MATCH(Projektname, Projektbeschreibung, Anmerkungsteil, Untergliederung)
          AGAINST ('Getreide' IN BOOLEAN MODE) AND ID_Thema!='14'
         * 
         * SELECT asx.ID_HS,asx.Schluessel,asx.ID_Projekt,asx.count_data,asx.min_jahr_sem,asx.max_jahr_sem,MD5(Quelle) as q_index 
         * FROM Aka_Projekte INNER JOIN aka_schluesselindex asx USING(ID_Projekt)
          INNER JOIN Lit_ZR
         * USING (ID_HS,Schluessel) 
         * WHERE
          ID_Thema!='14' AND MATCH(Quelle)
          AGAINST ('Getreide' IN BOOLEAN MODE)
         * 
         * SELECT asx.ID_HS,asx.Schluessel,asx.ID_Projekt,asx.count_data,asx.min_jahr_sem,asx.max_jahr_sem FROM Aka_Projekte 
         * INNER JOIN aka_schluesselindex asx 
         * USING(ID_Projekt) WHERE 
          ID_Thema!='14' AND MATCH(schluessel_index,hs_name)
          AGAINST ('Getreide' IN BOOLEAN MODE)
         */
        return array();
    }

}